$(".editar_rota").click(function (e) {
    e.preventDefault();

    var idRota = $(this).data("id-rota");

    $.ajax({
        type: 'GET',
        url: '/busca/rota/' +idRota,
        contentType: 'application/json',
    }).done(function (data) {
        var conteudoResposta = data.conteudoResposta;

        localStorage.setItem('atualizar_nome_rota', conteudoResposta.nome);
        localStorage.setItem('atualiza_cidade_rota', conteudoResposta.cidade);

    }).fail(function () {
        menssagemDeErro('Rota não encotrada!!');
    });

    window.location.href="/rota/atualizar/" + idRota;
});

$(".remove_rota").click(function (e){
    e.preventDefault()

    var idRota = $(this).data("id-rota");
    mensagemConfirmacao("Deseja excluir essa Rota? A exclusão acarretará na exclusão dos vínculos relacionados a ela!!", funcDeleteRota, idRota);
});

$(".listar_vinculos_rota").click(function (e) {
    e.preventDefault();

    var idRota = $(this).data("id-rota");
    window.location.href="/rota/vinculos/" +idRota;
})

var funcDeleteRota = function requestDeleteRota(idRota) {
    $.ajax({
        url: '/rota/' + idRota,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Rota removida com sucesso!!', '/rota/listar-todos');
        },
        error: function (){
            menssagemDeErro('Ouve um problema!!, rota não removida');
        }
    });
}