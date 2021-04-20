$("#salvar-rota-atualizar").click(function (e) {

    e.preventDefault()
    e.stopPropagation();

    let id = window.location.href;
    id = id.split('/');
    let idRota = id[5]

    var nome =  $("#nome_rota-atualizar").val();
    var cidade = $("#cidade_rota-atualizar").val();

    var json = serializadorRota(nome, cidade);

    realizaRequestAtualizaRota(idRota, json);

    window.location.href= "/rota/listar-todos";
});

function realizaRequestAtualizaRota(idRota, json) {

    $.ajax({
        type: 'PUT',
        url: 'http://localhost:8080/rota/' + idRota,
        contentType: 'application/json',
        data: json
    }).done(function () {
        alert('SUCCESS');
    }).fail(function (msg) {
        alert('FAIL');
    }).always(function (msg) {
        alert('ALWAYS');
    });
}

$("#limpar-rota-atualizar").click( function (e) {
    e.preventDefault();

    $("#nome_rota-atualizar").val("");
    $("#cidade_rota-atualizar").val("");
})