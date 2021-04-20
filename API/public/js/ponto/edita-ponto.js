$("#salvar-ponto-atualizar").click(function (e) {

    e.preventDefault()
    e.stopPropagation();

    let id = window.location.href;
    id = id.split('/');
    let idPonto = id[5]

    var nome= $("#nome_ponto-atualizar").val();
    var bairro = $("#bairro_ponto-atualizar").val();
    var rua = $("#rua_ponto-atualizar").val();
    var ponto_referencia = $("#ponto_ref_ponto-atualizar").val();


    var json = serializadorPonto(nome, bairro, rua, ponto_referencia);

    realizaRequestAtualizaPonto(idPonto, json);

    window.location.href= "/ponto/listar-todos";
});

function realizaRequestAtualizaPonto(idPonto, json) {

    $.ajax({
        type: 'PUT',
        url: 'http://localhost:8080/ponto/' + idPonto,
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

$("#limpar-ponto-atualizar").click( function (e) {
    e.preventDefault();

    $("#nome_ponto-atualizar").val("");
    $("#bairro_ponto-atualizar").val("");
    $("#rua_ponto-atualizar").val("");
    $("#ponto_ref_ponto-atualizar").val("");
})