$(".editar_alunos").click(function (e) {
    e.preventDefault();

    var idAluno = $(this).data("id-aluno");
    window.location.href="/aluno/atualizar/" + idAluno
});

$(".remove_alunos").click(function (e){
    e.preventDefault();

    var idAluno = $(this).data("id-aluno");
    requestDeleteAluno(idAluno)
});

function requestDeleteAluno(idAluno) {
    $.ajax({
        url: '/aluno/' +idAluno,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Aluno excluido com sucesso!!')
        },
        error: function () {
            menssagemDeErro('Ouve um problema!!, aluno não excluido')
        }
    });
}