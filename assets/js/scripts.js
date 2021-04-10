$(function(){

    $('.cep').mask('00000-000');

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
});