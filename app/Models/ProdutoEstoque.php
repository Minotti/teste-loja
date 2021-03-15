<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoEstoque extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function produtoAtributos()
    {
        return $this->belongsToMany(AtributoValores::class, 'produto_atributos', 'produto_estoque_id', 'atributo_valor_id');
    }

    public function movimentacao()
    {
        return $this->hasMany(Movimentacoes::class, 'produto_estoque_id');
    }
}
