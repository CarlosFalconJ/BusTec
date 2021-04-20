$("#salvar-onibus-atualizar").click(function (e) {

    e.preventDefault()
    e.stopPropagation();

    let id = window.location.href;
    id = id.split('/');
    let idOnibus = id[5]

    var motorista_responsavel = $("#nome_motorista_onibus-atualizar").val();
    var placa = $("#numero_placa_onibus-atualizar").val();


    var json = serializadorOnibus(motorista_responsavel, placa);

    realizaRequestOnibus(idOnibus, json);

    window.location.href= "/onibus/listar-todos";
});

function realizaRequestOnibus(idOnibus, json) {

    $.ajax({
        type: 'PUT',
        url: 'http://localhost:8080/onibus/' + idOnibus,
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