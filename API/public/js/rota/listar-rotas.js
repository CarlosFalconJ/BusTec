$(".editar_rota").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    var idRota = $(this).data("id-rota");

    window.location.href="/rota/atualizar/" + idRota
});

$(".remove_rota").click(function (e){
    var idRota = $(this).data("id-rota");

    requestDeleteRota(idRota)

    window.location.href="/rota/listar-todos"
});

function requestDeleteRota(idRota) {

    $.ajax({
        url: '/rota/' + idRota,
        type: 'DELETE',
        success: function(result) {
            alert('removido com sucesso')
        }
    });
}