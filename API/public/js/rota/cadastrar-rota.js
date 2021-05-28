$("#salvar-rota-cadastro").click(function (e) {
    e.preventDefault();

    var nome = $("#nome_rota-cadastro").val();
    var cidade = $("#cidade_rota-cadastro").val();

    var json = serializadorRota(nome, cidade);

    $.post("/rota", json, function () {
        menssagemDeSucesso('Rota cadastrada com sucesso!!', '/rota/listar-todos');
    }).fail(function (){
        menssagemDeErro('Rota não cadastrada!!, verifique os dados e tente novamente');
    })
});

function serializadorRota(nome, cidade) {
    var dados =  {
        "nome": nome,
        "cidade": cidade,
    }
    var json = JSON.stringify(dados);

    return json;
}

$("#limpar-rota-cadastro").click( function (e) {
    e.preventDefault();

    $("#nome_rota-cadastro").val("");
    $("#cidade_rota-cadastro").val("");
})