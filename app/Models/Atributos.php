<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atributos extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function valores()
    {
        return $this->hasMany(AtributoValores::class, 'atributo_id');
    }
}
