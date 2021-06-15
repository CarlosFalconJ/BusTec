$(".editar_vinculo_rota_onibus").click(function (e) {
    e.preventDefault();

    var idVinculo = $(this).data("id-rota-onibus");

    $.ajax({
        type: 'GET',
        url: '/busca/rota/onibus/vinculo/' + idVinculo,
        contentType: 'application/json',
    }).done(function (data) {
        var conteudoResposta = data.conteudoResposta;

        localStorage.setItem('atualizar_vinculo_rota-o', conteudoResposta.rota.id);
        localStorage.setItem('atualizar_vinculo_onibus', conteudoResposta.onibus.id);

    }).fail(function () {
        menssagemDeErro('O vínculo não existe!!');
    });

    window.location.href="/vinculo/" + idVinculo + "/rota/onibus";
});

$(".remove_vinculo_rota_onibus").click(function (e){
    e.preventDefault()

    let id = window.location.href;
    id = id.split('/');
    let idRota = id[5];

    var idVinculo = $(this).data("id-rota-onibus");
    mensagemConfirmacao("Deseja excluir esse Vínculo?", funcDeleteVinculoRotaOnibus, [idVinculo , idRota]);
});


var funcDeleteVinculoRotaOnibus = function requestDeleteVinculo([idVinculos, idRota]) {
    $.ajax({
        url: '/rota/onibus/' + idVinculos,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Vínculo removido com sucesso!!', '/rota/vinculos/' + idRota);
        },
        error: function (){
            menssagemDeErro('Ouve um problema!!, vínculo não removido');
        }
    });
}