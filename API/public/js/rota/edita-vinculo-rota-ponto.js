$("#atualizar_vinculo-rota-ponto").click(function (e) {
    e.preventDefault();

    let id = window.location.href;
    id = id.split('/');
    let idVinculo = id[4];

    console.log(idVinculo);
    var idRota = $(".atualiza_vinculo-rota").val();
    var idPonto = $(".atualizar_vinculo-ponto").val();
    var data = $("#datetime-atualizar_rota-ponto").val();

    var json =  serializadorDate(data);

    realizaRequestAtualizaRotaPonto(idVinculo, idRota, idPonto, json);
});

function realizaRequestAtualizaRotaPonto(idVinculo, idRota, idPonto, json) {
    $.ajax({
        type: 'PUT',
        url: '/vinculo/' + idVinculo + '/rota/' + idRota +  '/ponto/' + idPonto,
        contentType: 'application/json',
        data: json
    }).done(function () {
        menssagemDeSucesso('Vínculo atualizado com sucesso!!', '/rota/vinculos/' + idRota);
    }).fail(function (msg) {
        menssagemDeErro('Vínculo não atualizado!!, verifique os dados e tente novamente');
    });
}

$("#limpar_vinculo-rota-ponto_atualizar").click(function (e) {
    e.preventDefault();

    $(".atualiza_vinculo-rota").val("Selecione a rota");
    $(".atualizar_vinculo-ponto").val("Selecione o ponto");
});