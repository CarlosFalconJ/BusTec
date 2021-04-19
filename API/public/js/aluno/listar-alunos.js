$(".editar_alunos").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    var idAluno = $(this).data("id-aluno");

    window.location.href="/aluno/atualizar/" + idAluno
});

$(".remove_alunos").click(function (e){
    var idAluno = $(this).data("id-aluno");

    requestDelete(idAluno)

    window.location.href="/aluno/listar-todos"
});


function requestDelete(idAluno) {

    $.ajax({
        url: '/aluno/' +idAluno,
        type: 'DELETE',
        success: function(result) {
            console.log('removido com sucesso')
        }
    });
}