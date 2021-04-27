$(".editar_onibus").click(function (e) {
    e.preventDefault();

    var idOnibus = $(this).data("id-onibus");
    window.location.href="/onibus/atualizar/" + idOnibus
});

$(".remove_onibus").click(function (e){
    e.preventDefault();

    var idOnibus = $(this).data("id-onibus");
    mensagemConfirmacao("Deseja excluir esse Ônibus? A exclusão acarretará na exclusão dos vínculos relacionados a ele!!", funcDeleteOnibus, idOnibus);
});

var funcDeleteOnibus = function requestDeleteOnibus(idOnibus) {
    $.ajax({
        url: '/onibus/' +idOnibus,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Ônibus excluido com sucesso!!', '/onibus/listar-todos');
        },
        error: function (){
            menssagemDeErro('Ops. Ônibus não excluido!! Certifique-se que não á nenhum aluno atribuido ao ônibus e tente novamente');
        }
    });
}