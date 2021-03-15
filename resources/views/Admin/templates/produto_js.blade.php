@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script>
        $('.select2').select2();
        $('.atributo_estoque').mask("#", {negative: false});
        $('.money').mask("#.##0,00", {reverse: true});

        @if(isset($produto) and $produto->variacao)
            $('#switch_variacao').prop( "checked", true );
            turnSwitch();
        @endif

        $('#atributos').on('change', function(ev) {
            $('.col-atributos').addClass('invisible_absolute');
            $('#atributos').focus().removeClass('is-invalid');
            $('.table').find('tbody tr').empty();

            $.each($(this).val(), function(ev, v) {
                $('.atributo_'+v).removeClass('invisible_absolute');
            })
        });

        $('#switch_variacao').on('change', function(ev) {
            turnSwitch();
        });

        $('.btn-add-valor').on('click', function(ev) {
            ev.preventDefault();
            $("#atributos").prop("disabled", true);
            $('.lock_atributo').removeClass('invisible').fadeIn();

            let preco = $('.atributo_preco').val();
            let estoque = $('.atributo_estoque').val();
            let atributos = $('#atributos').val();

            if(Object.keys(atributos).length == 0) {
                $('#atributos').focus().addClass('is-invalid');
                return false;
            }

            let nomes = [];
            let atributo_valores = [];
            let values = [];
            let dados = {'preco': preco, 'estoque': estoque}

            $.each(atributos, function(ev, v) {
                let $sel = $('.sel_atributo_'+v);
                let nome = $sel.find(':selected').data('nome');
                let atributo = $sel.find(':selected').data('atributo');
                let val = $sel.val();

                if(!preco || preco === 'undefined') {
                    $('.atributo_preco').focus().addClass('is-invalid');
                    return false;
                }

                nomes.push(nome);
                atributo_valores.push(atributo);
                values.push(val);
            });

            dados['nomes'] = nomes;
            dados['values'] = values;
            dados['atributos_valores'] = atributo_valores;

            populateTable(dados);
        });

        $(document).on('click', '.delete-row', function (ev) {
            ev.preventDefault();
            $(this).closest('tr').remove();

            if($('.table').find('tbody tr').length == 0) {
                $("#atributos").prop("disabled", false);
            }
        });

        $('.delete-estoque').on('click', function (ev) {
            ev.preventDefault();
            $(this).closest('tr').addClass('d-none');
            $(this).siblings('input[class="delete_row"]').val(true)
        });

        function populateTable(dados) {
            let html = '<tr data-nome="'+dados['nomes'].join(' | ')+'">';
            let tr = $('table [data-nome="'+dados['nomes'].join(' | ')+'"]');

            if(tr.length > 0) {
                $(tr).find('.span_preco').text('R$ '+dados.preco);
                $(tr).find('.span_estoque').text(dados.estoque);
                $(tr).find('.input_preco').val(dados.preco);
                $(tr).find('.input_estoque').val(dados.estoque);

                return true;
            }

            html += '<td>'+dados['nomes'].join(' | ')+'</td>';
            html += '<td><span class="span_preco">R$ '+dados.preco+'</span></td>';
            html += '<td><span class="span_estoque">'+dados.estoque+'</span></td>';
            html += '<td>' +
                '<a href="#" class="delete-row"><i class="fa fa-fw fa-trash text-red"></i></a>' +
                '<input type="hidden" name="atributo_valores['+dados.atributos_valores+'][preco]" value="'+dados.preco+'">' +
                '<input type="hidden" name="atributo_valores['+dados.atributos_valores+'][estoque]" value="'+dados.estoque+'">'
            '</td>';

            html += '</tr>'

            $('.table tbody').append(html);

            limpa();
        }

        function limpa() {
            $('.atributo_preco').val('');
            $('.atributo_estoque').val('');
        }

        function turnSwitch() {
            let variacao = $('#switch_variacao').prop("checked");

            if(variacao == true) {
                $('.variacao_switch').addClass('invisible').find('input').attr('disabled', 'true')
                $('.card-atributos').removeClass('invisible_absolute');
                $('#table').removeClass('invisible_absolute');
            } else {
                $('.variacao_switch').removeClass('invisible').find('input').removeAttr('disabled')
                $('.card-atributos').addClass('invisible_absolute');
                $('#table').addClass('invisible_absolute');
            }
        }
    </script>
@stop
