$("#salvar-ponto-cadastro").click(function (e) {

    var nome= $("#nome_ponto-cadastro").val();
    var bairro = $("#bairro_ponto-cadastro").val();
    var rua = $("#rua_ponto-cadastro").val();
    var ponto_referencia = $("#ponto_ref_ponto-cadastro").val();

    var json = serializadorPonto(nome, bairro, rua , ponto_referencia)

    console.log(json)

    $.post("http://localhost:8080/ponto", json, function () {
        alert("cadastrado");
    }).fail(function (){
        alert("falhou")
    })
});


function serializadorPonto(nome, bairro, rua, ponto_referencia ) {
    var dados =  {
        "nome": nome,
        "bairro": bairro,
        "rua": rua,
        "ponto_referencia": ponto_referencia,
    }

    var json = JSON.stringify(dados);

    return json;
}

$("#limpar-ponto-cadastro").click( function (e) {
    e.preventDefault()

    e.preventDefault();
    $("#nome_ponto-cadastro").val("");
    $("#bairro_ponto-cadastro").val("");
    $("#rua_ponto-cadastro").val("");
    $("#ponto_ref_ponto-cadastro").val("");
})