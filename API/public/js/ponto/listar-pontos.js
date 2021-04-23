$(".editar_ponto").click(function (e) {
    e.preventDefault();

    var idPonto = $(this).data("id-ponto");
    window.location.href="/ponto/atualizar/" + idPonto
});

$(".remove_ponto").click(function (e){
    e.preventDefault();

    var idPonto = $(this).data("id-ponto");
    requestDeletePonto(idPonto)
});

function requestDeletePonto(idPonto) {
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