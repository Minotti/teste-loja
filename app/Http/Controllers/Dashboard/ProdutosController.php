<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProdutoRepository;
use App\Models\Atributos;
use App\Models\Movimentacoes;
use App\Models\ProdutoEstoque;
use App\Models\Produtos;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    private $rqt, $atributos, $produtos, $estoque;

    public function __construct(Request $request, Atributos $atributos, Produtos $produtos, ProdutoEstoque $estoque)
    {
        $this->rqt = $request;
        $this->atributos = $atributos;
        $this->produtos = $produtos;
        $this->estoque = $estoque;
    }

    public function index()
    {
        $produtos = $this->produtos->with(['estoque.produtoAtributos.atributo'])->get();
        return view('Admin.produtos.index', compact('produtos'));
    }

    public function novo()
    {
        $atributos = $this->atributos->with('valores')->get();
        return view('Admin.produtos.novo', compact('atributos'));
    }

    public function postNovo()
    {
        $request = $this->rqt;

        try {
            beginTransaction();

            $repo = new ProdutoRepository($this->produtos);
            $repo->save($request);

            commit();

            return back()->with('sucesso', 'Produto cadastrado com sucesso');
        } catch (\Exception $e) {
            rollback();
            return back()->with('erro', 'Não foi possível completar a operação');
        }
    }

    public function editar()
    {
        $produto = Produtos::with(['estoque', 'produtoAtributos'])->find($this->rqt->id);
        $atributos = $this->atributos->with('valores')->get();
        $produtoAtributos = $produto->produtoAtributos->pluck('atributo_id')->unique()->toArray();

        return view('Admin.produtos.editar', compact('produto', 'atributos', 'produtoAtributos'));
    }

    public function postEditar()
    {
        $request = $this->rqt;

        try {
            beginTransaction();

            $repo = new ProdutoRepository($this->produtos);
            $repo->save($request, true);

            commit();

            return back()->with('sucesso', 'Produto alterado com sucesso');

        } catch (\Exception $e) {
            rollback();
            return back()->with('erro', 'Não foi possível completar a operação');

        }
    }

    public function movimentacao()
    {
        $produto = $this->produtos->with('estoque')->find($this->rqt->id);
        $estoque = $produto->estoque;

        $mov = $estoque->map(function($query) {
            return $query->movimentacao;
        })->filter(function ($filter) {
            return $filter->count() > 0;
        });

        $movimentacao = collect([]);

        foreach ($mov as $mv) {
            $movimentacao = $mv->merge($movimentacao);
        }

        return view('Admin.produtos.movimentacao', compact('estoque', 'movimentacao'));
    }

    public function postMovimentacao()
    {
        try {
            beginTransaction();

            $produto = new ProdutoRepository($this->estoque);
            $produto->movimentacao($this->rqt);

            commit();

            session()->flash('sucesso', 'Lançamento feito com sucesso');

            return back();

        } catch (\Exception $e) {
            rollback();
            return back()->with('erro', 'Não foi possível completar a operação');
        }

    }
}
