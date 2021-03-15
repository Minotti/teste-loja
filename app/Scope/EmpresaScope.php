<?php

namespace App\Scope;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class EmpresaScope implements Scope
{
    public function apply(Builder $builder, Model $model)
   {
        $user = \Auth::user();
        if(!$user){
            $builder;
        }else {
            $builder->where('empresa_id', '=', $user->empresa_id);
        }
    }
}