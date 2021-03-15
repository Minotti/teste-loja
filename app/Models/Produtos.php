<?php

namespace App\Models;

use App\Scope\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EmpresaScope());
    }

    public function estoque()
    {
        return $this->hasMany(ProdutoEstoque::class, 'produto_id');
    }

    public function produtoAtributos()
    {
        return $this->belongsToMany(AtributoValores::class, 'produto_atributos', 'produto_id', 'atributo_valor_id');
    }
}
