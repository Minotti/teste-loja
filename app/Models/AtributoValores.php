<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtributoValores extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function atributo()
    {
        return $this->belongsTo(Atributos::class, 'atributo_id');
    }
}
