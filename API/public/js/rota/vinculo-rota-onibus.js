$("#salvar_vinculo-rota-onibus").click(function (e) {
    e.preventDefault();

    var idRota = $(".escolha_vinculo-rota").val();
    var idOnibus = $(".escolha_vinculo-onibus").val();

    $.post("http://localhost:8080/rota/"+idRota +"/onibus/" + idOnibus, function () {
        menssagemDeSucesso('Vinculo realizada com sucesso!!');
    }).fail(function (){
        menssagemDeErro('Vinculo não realizado, verifique os dados e tente novamente');
    })
});

$("#limpar_vinculo-rota-onibus").click(function (e) {
    e.preventDefault();

    $(".escolha_vinculo-rota").val("Selecione a rota");
    $(".escolha_vinculo-onibus").val("Selecione o ônibus");
});

