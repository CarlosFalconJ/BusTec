
$("#salvar-aluno-atualizar").click(function (e) {
    e.preventDefault();

    let id = window.location.href;
    id = id.split('/');
    let idAluno = id[5]

    var nome = $("#nome_aluno-atualizar").val();
    var numero = $("#numero_aluno-atualizar").val();
    var email = $("#email_aluno-atualizar").val();
    var ra = $("#ra_aluno-atualizar").val();
    var bairro = $("#bairro_aluno-atualizar").val();
    var rua = $("#rua_aluno-atualizar").val();
    var num_casa = $("#numero_casa_aluno-atualizar").val();

    var json = serializadorAluno(nome, numero, email, ra, bairro, rua, num_casa);

    realizaRequestAtualizaAluno(idAluno, json);
});

function realizaRequestAtualizaAluno(idAluno, json) {
    $.ajax({
        type: 'PUT',
        url: 'http://localhost:8080/aluno/' + idAluno,
        contentType: 'application/json',
        data: json
    }).done(function () {
        menssagemDeSucesso('Dados do aluno atualizados com sucesso!!');
    }).fail(function () {
        menssagemDeErro('Dados não aatualizados!!, verifique os dados e tente novamente');
    });
}

$("#limpar-aluno-atualizar").click(function (e) {
    e.preventDefault();

    $("#nome_aluno-atualizar").val("");
    $("#numero_aluno-atualizar").val("");
    $("#email_aluno-atualizar").val("");
    $("#ra_aluno-atualizar").val("");
    $("#bairro_aluno-atualizar").val("");
    $("#rua_aluno-atualizar").val("");
    $("#numero_casa_aluno-atualizar").val("");
});


