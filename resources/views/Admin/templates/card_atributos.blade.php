<div class="card card-info card-atributos invisible_absolute">
    <div class="card-header">
        <h3 class="card-title">Atributos</h3>
    </div>

    <div class="card-body">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="" class="d-block">Atributos <i class="fa fa-fw fa-question-circle {{(isset($produto) and $produto->variacao) ? '' : 'invisible'}} lock_atributo" tabindex="0" data-toggle="tooltip" title="Remova os produtos da tabela para alterar os atributos."></i></label>
                    <select name="atributos[]" {{(isset($produto) and $produto->variacao) ? 'disabled' : ''}} id="atributos" class="form-control select2" style="width: 100%;" multiple>
                        @foreach($atributos as $at)
                            <option {{isset($produto) ? (in_array($at->id, $produtoAtributos) ? 'selected' : '' ) : ''}}
                                    value="{{$at->id}}">{{$at->nome}}</option>
                        @endforeach
                    </select>
                    <span class="error invalid-feedback">Informe ao menos um Atributo</span>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            @foreach($atributos as $k => $at)
                <div class="col col-atributos atributo_{{$at->id}} {{ isset($produto) ?
                    (in_array($at->id, $produtoAtributos) ? '' : 'invisible_absolute' ) : 'invisible_absolute' }}">
                    <div class="form-group">
                        <label for="" class="control-label">{{$at->nome}}</label>
                        <select {{isset($produto) and $produto->variacao ? 'disabled' : ''}} class="form-control sel_atributo_{{$at->id}}">
                            @foreach($at->valores as $v)
                                <option data-atributo="{{$v->id}}" data-nome="{{$v->nome}}" value="{{$v->id}}">{{$v->nome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endforeach

            <div class="col ">
                <label for="">Valor</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">R$</span>
                    </div>
                    <input type="text" class="form-control atributo_preco money">
                    <span class="error invalid-feedback">Informe um preço</span>
                </div>
            </div>

            <div class="col ">
                <label for="">Estoque Inicial</label>
                <input type="number" class="form-control atributo_estoque">
            </div>

            <div class="text-right ">
                <label class="d-block">&nbsp;</label>
                <a href="#" title="Adicionar" class="btn btn-success btn-add-valor"><i class="fa fa-fw fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>
