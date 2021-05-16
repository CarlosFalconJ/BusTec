$("#atualizar-vinculos-rota-onibus").ready(function () {
    $(".atualizar_vinculo-rota-o").val(localStorage.getItem(  'atualizar_vinculo_rota-o'));
    $(".atualizar_vinculo-onibus").val(localStorage.getItem('atualizar_vinculo_onibus'));
})

$("#atualizar_vinculo-rota-onibus").click(function (e) {
    e.preventDefault();

    let id = window.location.href;
    id = id.split('/');
    let idVinculo = id[4];

    console.log(idVinculo)

    var idRota = $(".atualizar_vinculo-rota-o").val();
    var idOnibus = $(".atualizar_vinculo-onibus").val();

    realizaRequestAtualizaRotaOnibus(idVinculo, idRota, idOnibus);
});

function realizaRequestAtualizaRotaOnibus(idVinculo, idRota, idOnibus) {
    $.ajax({
        type: 'PUT',
        url: '/vinculo/' + idVinculo + '/rota/' + idRota +  '/onibus/' + idOnibus,
        contentType: 'application/json',
    }).done(function () {
        menssagemDeSucesso('Vínculo atualizado com sucesso!!', '/rota/vinculos/' + idRota);
    }).fail(function (msg) {
        menssagemDeErro('Vínculo não atualizado!!, verifique os dados e tente novamente');
    });
}

$("#limpar_vinculo-rota-onibus").click(function (e) {
    e.preventDefault();

    $(".atualizar_vinculo-rota-o").val("Selecione a rota");
    $(".atualizar_vinculo-onibus").val("Selecione o ônibus");
});