$("#salvar-rota-atualizar").click(function (e) {
    e.preventDefault();

    let id = window.location.href;
    id = id.split('/');
    let idRota = id[5];

    var nome =  $("#nome_rota-atualizar").val();
    var cidade = $("#cidade_rota-atualizar").val();

    var json = serializadorRota(nome, cidade);

    realizaRequestAtualizaRota(idRota, json);
});

function realizaRequestAtualizaRota(idRota, json) {
    $.ajax({
        type: 'PUT',
        url: 'http://localhost:8080/rota/' + idRota,
        contentType: 'application/json',
        data: json
    }).done(function () {
        menssagemDeSucesso('Rota atualizada com sucesso!!');
    }).fail(function (msg) {
        menssagemDeErro('Rota não atualizada!!, verifique os dados e tente novamente');
    });
}

$("#limpar-rota-atualizar").click( function (e) {
    e.preventDefault();

    $("#nome_rota-atualizar").val("");
    $("#cidade_rota-atualizar").val("");
})