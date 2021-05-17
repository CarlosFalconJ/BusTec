$(".editar_vinculo_rota_onibus").click(function (e) {
    e.preventDefault();

    var idVinculo = $(this).data("id-rota-onibus");
    window.location.href="/vinculo/" + idVinculo + "/rota/onibus";
});

$(".remove_vinculo_rota_onibus").click(function (e){
    e.preventDefault()

    let id = window.location.href;
    id = id.split('/');
    let idRota = id[5];

    var idVinculo = $(this).data("id-rota-onibus");
    mensagemConfirmacao("Deseja excluir esse Vínculo?", funcDeleteVinculoRotaPonto, [idVinculo , idRota]);
});


var funcDeleteVinculoRotaPonto = function requestDeleteVinculo([idVinculos, idRota]) {
    $.ajax({
        url: '/rota/onibus/' + idVinculos,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Vínculo removido com sucesso!!', '/rota/vinculos/' + idRota);
        },
        error: function (){
            menssagemDeErro('Ouve um problema!!, vínculo não removido');
        }
    });
}