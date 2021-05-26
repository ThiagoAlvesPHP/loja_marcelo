$(function(){
    $('.cep').mask('00000-000');
    $('.price').mask('##0.00', {reverse: true});
    // $(document).ready(function(){
    //     $('.card-img-top').lightzoom();
    // });
    $(document).on('keyup', '#docNumber', function(){
        let cpf = $(this).val();
        if (cpf.length > 10) {
            $.ajax({
                type: 'POST',
                url: url+'home/ajax',
                data:{ cpf:cpf },
                success:function(data){
                    if (data == 1) {
                        $('#error_doc').html('"CPF Valido"');
                        $("#error_doc").css("color", "green");
                    } else {
                        $('#error_doc').html('"CPF Invalido"');
                        $("#error_doc").css("color", "red");
                    }
                }
            });
        }
    });
    //botões de adicionar e remover produto do carrinho
	$('.bt-acao').on('click keyup', function(e){
        e.preventDefault();
        var qt = parseInt($('.quantidade').val());
        var action = $(this).attr('data-action');
        let div = $(this).parent();
        if(action == 'decrease') {
            if(qt-1 >= 1) {
                qt = qt - 1;
            }
        }
        else if(action == 'increase') {
            qt = qt + 1;
        }
        $('.quantidade').val(qt);
        let valor = div.find('.valor').val();
        let sub = (parseFloat(valor) * qt);
        $(div.find('.subtotal span')).html(sub.toFixed(2));
    });
    //Quando o campo cep perde o foco.
    $(".cep").blur(function() {
        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');
        //Verifica se campo cep possui valor informado.
        if (cep != "") {
            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) 
            {
                //Preenche os campos com "..." enquanto consulta webservice.
                $(".cidade").val("...");
                $(".uf").val("...");
                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) 
                    {
                        //Atualiza os campos com os valores da consulta.
                        $(".endereco").val(dados.logradouro);
                        $(".complemento").val(dados.complemento);
                        $(".bairro").val(dados.bairro);
                        $(".cidade").val(dados.localidade);
                        $(".estado").val(dados.uf);
                        //$(".ibge").val(dados.ibge);
                    } //end if.
                    else 
                    {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        alert("CEP não encontrado.");
                        window.location.href="index.php";
                    }
                });
            } //end if.
            else 
            {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
                window.location.href="index.php";
            }
        } 
        else 
        {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
    //array vazio
    var array = [];
    //ajax datatable
    $(document).ready(function (){
        array['compras'] = true;
        //lista de compras
        $('#compras_list').DataTable({
            "processing": true,
            "serverSide": true,
            "language": {
                "lengthMenu": "_MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(Filtrado de _MAX_ registros no total)",
                "sSearch": "Pesquisar",
                "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
                },
            },
            "order": [[ 5, "desc" ]],
            "ajax": {
                "url": url+"admin/ajax",
                "type": "POST",
                "data":array
            }
        }); 
    });
    $(document).ready(function (){
        array['clientes'] = true;
        //lista de cliente
        $('#clientes_list').DataTable({
            "processing": true,
            "serverSide": true,
            "language": {
                "lengthMenu": "_MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(Filtrado de _MAX_ registros no total)",
                "sSearch": "Pesquisar",
                "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
                },
            },
            "order": [[ 1, "desc" ]],
            "ajax": {
                "url": url+"admin/ajax",
                "type": "POST",
                "data":array
            }
        });
    });
    $(document).ready(function (){
        array['usuarios'] = true;
        //lista de cliente
        $('#usuarios_list').DataTable({
            "processing": true,
            "serverSide": true,
            "language": {
                "lengthMenu": "_MENU_ registros por página",
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(Filtrado de _MAX_ registros no total)",
                "sSearch": "Pesquisar",
                "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
                },
            },
            "order": [[ 1, "asc" ]],
            "ajax": {
                "url": url+"admin/ajax",
                "type": "POST",
                "data":array
            }
        });
    });
});