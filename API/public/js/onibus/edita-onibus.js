$("#atualizar-onibus").ready(function () {
    $("#nome_motorista_onibus-atualizar").val(localStorage.getItem('nome_motorista_onibus_atualizar'));
    $("#numero_placa_onibus-atualizar").val(localStorage.getItem('placa_onibus_atualizar'));
})

$("#salvar-onibus-atualizar").click(function (e) {
    e.preventDefault();

    let id = window.location.href;
    id = id.split('/');
    let idOnibus = id[5];

    var motorista_responsavel = $("#nome_motorista_onibus-atualizar").val();
    var placa = $("#numero_placa_onibus-atualizar").val();

    var json = serializadorOnibus(motorista_responsavel, placa);
    realizaRequestAtualizaOnibus(idOnibus, json);
});

function realizaRequestAtualizaOnibus(idOnibus, json) {
    $.ajax({
        type: 'PUT',
        url: 'onibus/' + idOnibus,
        contentType: 'application/json',
        data: json
    }).done(function () {
        menssagemDeSucesso('Ônibus atualizado com sucesso!!', '/onibus/listar-todos');
    }).fail(function () {
        menssagemDeErro('Ônibus não atualizado!!, verifique os dados e tente novamente');
    });
}

$("#limpar-onibus-atualizar").click( function (e) {
    e.preventDefault();

    $("#nome_motorista_onibus-atualizar").val("");
    $("#numero_placa_onibus-atualizar").val("");
})