$(".editar_alunos").click(function (e) {
    e.preventDefault();

    var idAluno = $(this).data("id-aluno");

    $.ajax({
        type: 'GET',
        url: 'http://localhost:8080/busca/aluno/' +idAluno,
        contentType: 'application/json',
    }).done(function (data) {
        var conteudoResposta = data.conteudoResposta;

        localStorage.setItem('atualizar_nome_aluno', conteudoResposta.nome);
        localStorage.setItem('atualiza_numero_aluno', conteudoResposta.numero_contato);
        localStorage.setItem('email_aluno-atualizar', conteudoResposta.email);
        localStorage.setItem('ra_aluno-atualizar', conteudoResposta.ra);
        localStorage.setItem('bairro_aluno-atualizar', conteudoResposta.bairro);
        localStorage.setItem('rua_aluno-atualizar', conteudoResposta.rua);
        localStorage.setItem('numero_casa_aluno-atualizar', conteudoResposta.numero_casa);
        localStorage.setItem('escolha_onibus', conteudoResposta.id_onibus.id);

    }).fail(function () {
        menssagemDeErro('Aluno não encotrado!!');
    });

     window.location.href="/aluno/atualizar/" + idAluno
});

$(".remove_alunos").click(function (e){
    e.preventDefault();

    var idAluno = $(this).data("id-aluno");
    mensagemConfirmacao("Deseja Excluir o aluno?", funcDeleteAluno, idAluno);
});

var funcDeleteAluno = function requestDeleteAluno(idAluno) {
    $.ajax({
        url: '/aluno/' +idAluno,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Aluno excluido com sucesso!!', '/aluno/listar-todos');
        },
        error: function () {
            menssagemDeErro('Ouve um problema!!, aluno não excluido')
        }
    });
}