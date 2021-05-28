$("#salvar_vinculo-rota-ponto").click(function (e) {
    e.preventDefault();

    var idRota = $(".escolha_vinculo-rota-o").val();
    var idPonto = $(".escolha_vinculo-ponto").val();
    var data = $("#datetime-vinculo_rota-ponto").val();

    var json =  serializadorDate(data);

    $.post("/rota/"+idRota +"/ponto/" + idPonto, json ,function () {
        menssagemDeSucesso('Vinculo realizada com sucesso!!', '/rota/listar-todos');
    }).fail(function (){
        menssagemDeErro('Vinculo não realizado, verifique os dados e tente novamente');
    })
});

$("#limpar_vinculo-rota-ponto").click(function (e) {
    e.preventDefault();

    $(".escolha_vinculo-rota-o").val("Selecione a rota");
    $(".escolha_vinculo-ponto").val("Selecione o ponto");
});

function serializadorDate(data) {
    var dados =  {
        "horario": data,

    }
    var json = JSON.stringify(dados);

    return json;
}