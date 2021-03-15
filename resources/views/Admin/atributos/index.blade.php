@extends('adminlte::page')
@section('title', 'Novo Atributo')

@section('content_header')
    <h1>Novo Atributo</h1>
@stop
@section('content')
    <div class="container">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Novo Atributo</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" autocomplete="off" action="{{route('post.novo.atributo')}}" method="POST">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome</label>
                        <input autocomplete="off" type="text" name="nome" class="form-control" id="">
                        <small class="form-text text-muted">Exemplo: Tamanho</small>
                    </div>

                    <div class="form-group">
                        <label>Valores</label>
                        <select class="form-control select2bs4" multiple name="atributo_valores[]"></select>
                        <small class="form-text text-muted">Adicione os valores, exemplo: P, M, G</small>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('.select2bs4').select2({
            tags: true
        })
    </script>
@endsection
