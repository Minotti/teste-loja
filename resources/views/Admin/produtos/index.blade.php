@extends('adminlte::page')

@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Listagem de Produtos</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">

                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Estoque</th>
                        <th>Estoque Total</th>
                        <th>Operações</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $p)
                            <tr>
                                <td>
                                    <a href="{{\Storage::url($p->foto)}}" data-fancybox="images_{{$p->id}}" title="Clique para expandir">
                                        <img src="{{\Storage::url('thumbs/'.$p->foto)}}" alt="Arte" style="width: 35px">
                                    </a>
                                </td>
                                <td>{{$p->nome}}</td>
                                <td>
                                    @foreach($p->estoque as $e)
                                        <button data-toggle="tooltip" title="{{hintProduto($e->produtoAtributos)}}" type="button" class="btn btn-primary btn-sm">
                                            {{$e->nome}} <span class="badge badge-light">{{$e->qtd}}</span>
                                        </button>
                                    @endforeach
                                </td>
                                <td><span class="badge bg-success">{{$p->estoque->sum('qtd')}}</span></td>
                                <td>
                                    @role('gerente')
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-fw fa-th"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <a href="{{route('editar.produto', $p->id)}}" class="dropdown-item" type="button">Editar</a>
                                            <a href="{{route('movimentacao.produto', $p->id)}}" class="dropdown-item" type="button">Lançar Movimentação</a>
                                        </div>
                                    </div>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('button').tooltip();
    </script>
@endsection
