$("#salvar-ponto-cadastro").click(function (e) {
    e.preventDefault();

    var nome= $("#nome_ponto-cadastro").val();
    var bairro = $("#bairro_ponto-cadastro").val();
    var rua = $("#rua_ponto-cadastro").val();
    var ponto_referencia = $("#ponto_ref_ponto-cadastro").val();

    var json = serializadorPonto(nome, bairro, rua , ponto_referencia)

    $.post("/ponto", json, function () {
        menssagemDeSucesso('Ponto cadastrado de sucesso!!', '/ponto/listar-todos')
    }).fail(function (){
        menssagemDeErro('Ponto não cadastrado!!, verifique os dados e tente novamente');
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

    $("#nome_ponto-cadastro").val("");
    $("#bairro_ponto-cadastro").val("");
    $("#rua_ponto-cadastro").val("");
    $("#ponto_ref_ponto-cadastro").val("");
})