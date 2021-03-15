@extends('adminlte::page')

@section('title', 'Lançar Movimentação')

@section('content_header')
    <h1>Lançar Movimentação</h1>
@stop

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Lançar Movimentação</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form id="mov" method="POST" action="{{route('post.movimentacao.produto')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label for="">Tipo</label>
                                    <select name="tipo" required class="form-control">
                                        <option value="1">Entrada</option>
                                        <option value="2">Saída</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Estoque</label>
                                    <select name="estoque_id" required class="form-control">
                                        @foreach($estoque as $e)
                                            <option value="{{$e->id}}">{{$e->nome}} - {{$e->qtd}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Saldo</label>
                                    <input type="number" name="saldo" class="form-control saldo">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <button form="mov" type="submit" class="btn btn-primary submit">Salvar</button>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>

    <div class="card card-info">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Movimentações do Produto</h3>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered simplesDataTable table-hover dataTable dtr-inline">
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Estoque</th>
                        <th>Tipo</th>
                        <th>Anterior</th>
                        <th>Entrada</th>
                        <th>Atual</th>
                        <th>Data / Hora</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($movimentacao as $m)
                    <tr>
                        <td>{{$m->user->name}}</td>
                        <td>{{$m->produto->nome}}</td>
                        <td>{{tipoMov($m->tipo)}}</td>
                        <td>{{$m->anterior}}</td>
                        <td>{{$m->entrada}}</td>
                        <td>{{$m->atual}}</td>
                        <td>{{\Carbon\Carbon::parse($m->created_at)->format('d-m-Y H:i:s')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>

    <script>
        $('.saldo').mask("#");
        datatable.api().order(6, 'desc').draw();
    </script>
@endsection
