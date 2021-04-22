$(".editar_onibus").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    var idOnibus = $(this).data("id-onibus");

    window.location.href="/onibus/atualizar/" + idOnibus
});

$(".remove_onibus").click(function (e){
    e.preventDefault();
    var idOnibus = $(this).data("id-onibus");

    requestDeleteOnibus(idOnibus)
});


function requestDeleteOnibus(idOnibus) {

    $.ajax({
        url: '/onibus/' +idOnibus,
        type: 'DELETE',
        success: function() {
            menssagemDeSucesso('Ônibus removido com sucesso!!')
        },
        error: function (){
            menssagemDeErro('Ouve um problema!!, ônibus não excluido')
        }
    });
}