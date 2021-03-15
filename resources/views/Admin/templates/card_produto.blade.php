<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">{{isset($produto) ? 'Editar' : 'Novo'}} Produto</h3>
    </div>
    <div class="card-body">
        <form id="cad" action="{{$form}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}
            @if(isset($produto))
                <input type="hidden" name="id" value="{{$produto->id}}">
            @endif
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Nome</label>
                                <input type="text" name="nome" required value="{{isset($produto) ? (old('nome') ?? $produto->nome) : ''}}" class="form-control">
                            </div>

                            @if(!isset($produto) or $produto->variacao == 0)
                                <div class="col-md-3 variacao_switch">
                                    <label for="">Preço</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">R$</span>
                                        </div>
                                        <input type="text" name="preco" value="{{isset($produto) ? (old('preco') ?? $produto->estoque[0]->preco) : ''}}" class="form-control money">
                                    </div>
                                </div>

                                <div class="col-md-2 variacao_switch">
                                    <label for="">Estoque Inicial</label>
                                    <input type="text" name="estoque" value="{{isset($produto) ? (old('estoque') ?? $produto->estoque[0]->qtd) : ''}}" class="form-control">
                                </div>
                            @endif

                                <div class="col-md-6">
                                    <label for="" class="d-block">Foto</label>
                                    <input type="file" {{!isset($produto) ? 'required' : ''}} name="foto">
                                    <small class="form-text text-muted">Selecione uma imagem em formatado quadrado, por exemplo: 400x400</small>
                                </div>

                            <div class="col-md-4 {{isset($produto) ? 'invisible_absolute' : '' }}">
                                <label for="" class="control-label">&nbsp;</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" name="variacao" id="switch_variacao">
                                    <label class="custom-control-label" for="switch_variacao">Produto com variação?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 invisible_absolute" id="table">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Atributos</th>
                            <th>Valor</th>
                            <th>Estoque</th>
                            <th><i class="fa fa-fw fa-gears"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(isset($produto) and $produto->variacao)
                                @foreach($produto->estoque as $e)
                                    <tr data-nome="{{$e->nome}}">
                                        <td>{{$e->nome}}</td>
                                        <td><span class="span_preco">{{moeda($e->valor_cents)}}</span></td>
                                        <td><span class="span_estoque">{{$e->qtd}}</span></td>
                                        <td>
                                            <a href="#" class="delete-estoque"><i class="fa fa-fw fa-trash text-red"></i></a>
                                            <input type="hidden" name="atributo_valores[{{makeIdAtributosValores($e)}}][estoque_id]" value="{{$e->id}}">
                                            <input type="hidden" class="delete_row" name="atributo_valores[{{makeIdAtributosValores($e)}}][delete]">
                                            <input type="hidden" class="input_preco" name="atributo_valores[{{makeIdAtributosValores($e)}}][preco]" value="{{moeda($e->valor_cents)}}">
                                            <input type="hidden" class="input_estoque" name="atributo_valores[{{makeIdAtributosValores($e)}}][estoque]" value="{{$e->qtd}}">
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <div class="card-footer">
        <button form="cad" type="submit" class="btn btn-primary submit">Salvar</button>
    </div>
</div>
