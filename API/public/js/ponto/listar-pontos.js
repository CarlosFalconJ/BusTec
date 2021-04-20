$(".editar_ponto").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    var idPonto = $(this).data("id-ponto");

    window.location.href="/ponto/atualizar/" + idPonto
});

$(".remove_onibus").click(function (e){
    var idPonto = $(this).data("id-ponto");

    requestDeletePonto(idPonto)

    window.location.href="/onibus/listar-todos"
});


function requestDeletePonto(idPonto) {

    $.ajax({
        url: '/ponto/' +idPonto,
        type: 'DELETE',
        success: function(result) {
            alert('removido com sucesso')
        }
    });
}