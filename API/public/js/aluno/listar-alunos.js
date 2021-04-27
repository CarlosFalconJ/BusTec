$(".editar_alunos").click(function (e) {
    e.preventDefault();

    var idAluno = $(this).data("id-aluno");
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