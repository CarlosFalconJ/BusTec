$(".editar_ponto").click(function (e) {
    e.preventDefault();

    var idPonto = $(this).data("id-ponto");
    window.location.href="/ponto/atualizar/" + idPonto
});

$(".remove_ponto").click(function (e){
    e.preventDefault();

    var idPonto = $(this).data("id-ponto");
    mensagemConfirmacao("Deseja excluir esse Ponto? A exclusão acarretará na exclusão dos vínculos relacionados a ele!!", funcDeletePonto, idPonto);
});

var funcDeletePonto = function requestDeletePonto(idPonto) {
    $.ajax({
        url: '/ponto/' +idPonto,
        type: 'DELETE',
        success: function(result) {
            menssagemDeSucesso('Ponto removido com sucesso!!', '/ponto/listar-todos')
        },
        error: function (){
            menssagemDeErro('Ouve um problema!!, ponto não removido')
        }
    });
}