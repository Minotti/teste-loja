@extends('adminlte::page')

@section('title', 'Editar Produto')

@section('content_header')
    <h1>Editar Produto</h1>
@stop

@section('content')
    <div class="container-fluid">
        @include('Admin.templates.card_produto', ['form' => route('post.editar.produto')])

        @include('Admin.templates.card_atributos')
    </div>
@stop

@section('css')
@stop

@include('Admin.templates.produto_js')
