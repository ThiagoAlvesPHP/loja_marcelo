//DEFINIR SE É EM PRODUÇÃO OU~DESENVOLVIMENTO
var url_local = window.location.href;
if(url_local.indexOf('localhost')==-1) {
    var url = 'https://www.mercax.com.br/loja_marcelo/';
} else {
    var url = 'http://localhost/PROJETOS_ANDAMENTO/loja_marcelo/';
}