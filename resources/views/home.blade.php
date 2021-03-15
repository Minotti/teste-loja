@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$prod_count}}</h3>

                            <p>Produtos</p>
                        </div>

                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="{{route('produtos')}}" class="small-box-footer">
                            Listar <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$estoque}}</h3>

                            <p>Estoque Total</p>
                        </div>

                        <div class="icon">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <a href="{{route('produtos')}}" class="small-box-footer">
                            Listar <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$usuarios}}</h3>

                            <p>Usuários</p>
                        </div>

                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card card-info">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Últimas movimentações do Produto</h3>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-hover dataTable dtr-inline">
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
                        @foreach($ultimas_mov as $m)
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
        </div>
    </div>
@endsection
