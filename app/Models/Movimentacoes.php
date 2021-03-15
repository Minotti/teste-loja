<?php

namespace App\Models;

use App\Scope\EmpresaScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacoes extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new EmpresaScope());
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produto()
    {
        return $this->belongsTo(ProdutoEstoque::class, 'produto_estoque_id');
    }
}
