<?php

namespace App\Http\Repositories;

use App\Models\AtributoValores;
use App\Models\Movimentacoes;
use App\Models\ProdutoEstoque;
use App\Models\Produtos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use JansenFelipe\Utils\Utils;

class ProdutoRepository
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function save($request, $update = false)
    {
        $path_original = '';
        $variacao = isset($request->variacao) ?? false;

        $produto = $this->model;

        if($update) {
            $produto = $this->model->find($request->id);
        }

        if($request->foto) {
            $foto = $request->foto;
            $path_original = ImagemRepository::upload($foto);

            if($update)
                ImagemRepository::delete($produto->foto);
        }

        $produto->empresa_id = empresaId();
        $produto->nome = $request->nome;
        $produto->foto = $path_original;
        $produto->variacao = $variacao;

        $produto->save();

        if($variacao) {
            foreach ($request->atributo_valores as $key => $v) {
                $insert = [];
                $atributo_valores_id = explode(',', $key);

                $nome = AtributoValores::whereIn('id', $atributo_valores_id)->get()->pluck('nome')->toArray();
                $cents = Utils::unmoeda($v['preco']) * 100;

                if(isset($v['estoque_id'])) {
                    $estoque = ProdutoEstoque::find(($v['estoque_id']));

                    # SoftDeletes
                    if($v['delete']) {
                        $estoque->delete();
                        continue;
                    }

                    $estoque->valor_cents = $cents;
                    $estoque->qtd = $v['estoque'];
                    $estoque->save();

                } else {
                    $estoque = new ProdutoEstoque([
                        'nome' => implode(" | ", $nome),
                        'valor_cents' => $cents,
                        'qtd' => $v['estoque']
                    ]);

                    $estoque = $produto->estoque()->save($estoque);
                }

                if(!isset($v['estoque_id'])) {
                    foreach ($atributo_valores_id as $id) {
                        $insert[$id] = ['produto_estoque_id' => $estoque->id];
                    }

                    #Crio as variações
                    $produto->produtoAtributos()->attach($insert);
                }
            }

            return true;
        }

        $cents = Utils::unmoeda($request->valor) * 100;

        $estoque = new ProdutoEstoque([
            'nome' => $request->nome,
            'valor_cents' => $cents,
            'qtd' => $request->estoque
        ]);

        $produto->estoque()->save($estoque);

        return true;
    }

    public function movimentacao($request)
    {
        $estoque = $this->model->find($request->estoque_id);

        $tipo = $request->tipo;
        $saldo = $request->saldo;
        $estoque_atual = $estoque->qtd;

        $novo_saldo = $tipo == 1 ? $estoque_atual + +$saldo : $estoque_atual + -$saldo;

        $estoque->qtd = $novo_saldo > 0 ? $novo_saldo : 0;

        $mov = new Movimentacoes([
            'user_id' => auth()->user()->id,
            'empresa_id' => empresaId(),
            'anterior' => $estoque->getOriginal('qtd'),
            'entrada' => $saldo,
            'atual' => $estoque->qtd,
            'tipo' => $tipo
        ]);

        $estoque->movimentacao()->save($mov);

        $estoque->save();

        return true;
    }
}
