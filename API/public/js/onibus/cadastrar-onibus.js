$("#salvar-onibus-cadastro").click(function () {
    var motorista_responsavel = $("#nome_motorista_onibus-cadastro").val();
    var placa = $("#numero_placa_onibus-cadastro").val();

    var json = serializadorOnibus(motorista_responsavel, placa)

    $.post("http://localhost:8080/onibus", json, function () {
        alert("cadastrado");
    }).fail(function (){
        alert("falhou")
    })
});


function serializadorOnibus(motorista_resposavel, placa) {
    var dados =  {
        "motorista_responsavel": motorista_resposavel,
        "placa": placa,
    }

    var json = JSON.stringify(dados);

    return json;
}

$("#limpar-onibus-cadastro").click( function (e) {
    e.preventDefault();
    $("#nome_motorista_onibus-cadastro").val("");
    $("#numero_placa_onibus-cadastro").val("");
})