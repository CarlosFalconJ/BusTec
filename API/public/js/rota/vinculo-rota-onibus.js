$("#salvar_vinculo-rota-onibus").click(function (e) {
    e.preventDefault();

    var idRota = $(".escolha_vinculo-rota").val();
    var idOnibus = $(".escolha_vinculo-onibus").val();

    $.post("http://localhost:8080/rota/"+idRota +"/onibus/" + idOnibus, function () {
        alert("cadastrado");
    }).fail(function (){
        alert("falhou")
    })
})


