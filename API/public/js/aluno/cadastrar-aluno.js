$("#salvar-aluno-cadastro").click(function () {
    var nome = $("#nome_aluno-cadastro").val();
    var numero = $("#numero_aluno-cadastro").val();
    var email = $("#email_aluno-cadastro").val();
    var ra = $("#ra_aluno-cadastro").val();
    var bairro = $("#bairro_aluno-cadastro").val();
    var rua = $("#rua_aluno-cadastro").val();
    var num_casa = $("#numero_casa_aluno-cadastro").val();
    var idOnibus = $(".escolha-onibus").val();


    var json = serializadorAluno(nome, numero, email, ra, bairro,rua, num_casa)

    $.post("http://localhost:8080/onibus/"+ idOnibus + "/aluno", json, function () {
        alert("cadastrado");
    }).fail(function (){
        alert("falhou")
    })
});



$("#limpar-aluno-cadastro").click(function (e) {
    e.preventDefault();

    $("#nome_aluno-cadastro").val("");
    $("#numero_aluno-cadastro").val("");
    $("#email_aluno-cadastro").val("");
    $("#ra_aluno-cadastro").val("");
    $("#bairro_aluno-cadastro").val("");
    $("#rua_aluno-cadastro").val("");
    $("#numero_casa_aluno-cadastro").val("");
})

function serializadorAluno(nome, numero, email, ra, bairro, rua, num_casa) {
    var dados =  {
        "nome": nome,
        "email": email,
        "numero_contato": numero,
        "ra": ra,
        "bairro": bairro,
        "rua": rua,
        "numero_casa": num_casa
    }

    var json = JSON.stringify(dados);

    return json;
}

