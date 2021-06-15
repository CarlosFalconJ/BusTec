$(".editar_vinculo_rota_ponto").click(function (e) {
    e.preventDefault();

    var idVinculo = $(this).data("id-rota-ponto");

    $.ajax({
        type: 'GET',
        url: '/busca/rota/ponto/vinculo/' + idVinculo,
        contentType: 'application/json',
    }).done(function (data) {
        var conteudoResposta = data.conteudoResposta;

        localStorage.setItem('atualizar_vinculo_rota', conteudoResposta.rota.id);
        localStorage.setItem('atualizar_vinculo_ponto', conteudoResposta.ponto.id);

    }).fail(function () {
        menssagemDeErro('O vínculo não existe!!');
    });

    window.location.href="/vinculo/" + idVinculo + "/rota/ponto";
});

$(".remove_vinculo_rota_ponto").click(function (e){
    e.preventDefault()

    let id = window.location.href;
    id = id.split('/');
    let idRota = id[5];

    var idVinculo = $(this).data("id-rota-ponto");

    mensagemConfirmacao("Deseja excluir esse Vínculo?", funcDeleteVinculoRotaPonto, [idVinculo , idRota]);
});


var funcDeleteVinculoRotaPonto = function requestDeleteVinculo([idVinculos, idRota]) {

    $.ajax({
        url: '/rota/ponto/' + idVinculos,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Vínculo removido com sucesso!!', '/rota/vinculos/' + idRota);
        },
        error: function (){
            menssagemDeErro('Ouve um problema!!, vínculo não removido');
        }
    });
}