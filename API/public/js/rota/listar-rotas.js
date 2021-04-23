$(".editar_rota").click(function (e) {
    e.preventDefault();

    var idRota = $(this).data("id-rota");
    window.location.href="/rota/atualizar/" + idRota;
});

$(".remove_rota").click(function (e){
    var idRota = $(this).data("id-rota");

    requestDeleteRota(idRota);
});

function requestDeleteRota(idRota) {
    $.ajax({
        url: '/rota/' + idRota,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Rota removida com sucesso!!', '/rota/listar-todos');
        },
        error: function (){
            menssagemDeErro('Rota um problema!!, ponto não removida');
        }
    });
}