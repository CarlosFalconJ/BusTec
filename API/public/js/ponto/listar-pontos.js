$(".editar_ponto").click(function (e) {
    e.preventDefault();

    var idPonto = $(this).data("id-ponto");

    $.ajax({
        type: 'GET',
        url: '/busca/ponto/' +idPonto,
        contentType: 'application/json',
    }).done(function (data) {
        var conteudoResposta = data.conteudoResposta;

        localStorage.setItem('nome_ponto-atualizar', conteudoResposta.nome);
        localStorage.setItem('bairro_ponto-atualizar', conteudoResposta.bairro);
        localStorage.setItem('rua_ponto-atualizar', conteudoResposta.rua);
        localStorage.setItem('ponto_referencia-atualizar', conteudoResposta.ponto_referencia);


    }).fail(function () {
        menssagemDeErro('Ponto não encotrado!!');
    });

    window.location.href="/ponto/atualizar/" + idPonto
});

$(".remove_ponto").click(function (e){
    e.preventDefault();

    var idPonto = $(this).data("id-ponto");
    mensagemConfirmacao("Deseja excluir esse Ponto? A exclusão acarretará na exclusão dos vínculos relacionados a ele!!", funcDeletePonto, idPonto);
});

var funcDeletePonto = function requestDeletePonto(idPonto) {
    $.ajax({
        url: '/ponto/' +idPonto,
        type: 'DELETE',
        success: function(result) {
            menssagemDeSucesso('Ponto removido com sucesso!!', '/ponto/listar-todos')
        },
        error: function (){
            menssagemDeErro('Ouve um problema!!, ponto não removido')
        }
    });
}