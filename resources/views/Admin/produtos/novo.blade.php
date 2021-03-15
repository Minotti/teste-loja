@extends('adminlte::page')

@section('title', 'Novo Produto')

@section('content_header')
    <h1>Novo Produto</h1>
@stop

@section('content')
    <div class="container-fluid">
        @include('Admin.templates.card_produto', ['form' => route('post.novo.produto')])

        @include('Admin.templates.card_atributos')
    </div>
@stop

@section('css')
@stop

@include('Admin.templates.produto_js')
