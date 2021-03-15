<?php
if( !function_exists('enableQueryLog') ){
    function enableQueryLog(){
        \DB::enableQueryLog();
    }
}

if( !function_exists('getQueryLog') ){
    function getQueryLog(){
        return \DB::getQueryLog();
    }
}

if( !function_exists('beginTransaction') ){
    function beginTransaction(){
        \DB::beginTransaction();
    }
}

if( !function_exists('commit') ){
    function commit(){
        \DB::commit();
    }
}

if( !function_exists('rollback') ){
    function rollback(){
        \DB::rollback();
    }
}

if( !function_exists('empresaId') ){
    function empresaId(){
        return auth()->user()->empresa_id;
    }
}

if( !function_exists('makeIdAtributosValores') ){
    function makeIdAtributosValores(\App\Models\ProdutoEstoque $e){
        return implode(',', $e->produtoAtributos()->pluck('atributo_valor_id')->toArray());
    }
}

if( !function_exists('moeda') ){
    function moeda($cents){
        return \JansenFelipe\Utils\Utils::moeda(($cents / 100));
    }
}

if( !function_exists('hintProduto') ){
    function hintProduto($atributos){
        $hint = [];
        foreach ($atributos as $a) {
            $hint[] = $a->atributo->nome;
        }

        return implode(' | ', $hint);
    }
}

if( !function_exists('tipoMov') ){
    function tipoMov($tipo){
        return $tipo == 1 ? 'Entrada' : 'Saída';
    }
}


