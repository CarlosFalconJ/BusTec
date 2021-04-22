$("#salvar_vinculo-rota-ponto").click(function (e) {
    e.preventDefault();

    var idRota = $(".escolha_vinculo-rota-o").val();
    var idPonto = $(".escolha_vinculo-ponto").val();
    var data = $("#datetime-vinculo_rota-ponto").val();

    var json =  serializadorDate(data)
    console.log(json)


    $.post("http://localhost:8080/rota/"+idRota +"/ponto/" + idPonto, json ,function () {
        alert("cadastrado");
    }).fail(function (){
        alert("falhou")
    })
})

$("#limpar_vinculo-rota-ponto").click(function (e) {
    e.preventDefault();

    $(".escolha_vinculo-rota-o").val("Selecione a rota");
    $(".escolha_vinculo-ponto").val("Selecione o ponto");

})

function serializadorDate(data) {
    var dados =  {
        "horario": data,

    }

    var json = JSON.stringify(dados);

    return json;

}