$(".editar_onibus").click(function (e) {
    e.preventDefault();
    e.stopPropagation();
    var idOnibus = $(this).data("id-onibus");

    window.location.href="/onibus/atualizar/" + idOnibus
});

$(".remove_onibus").click(function (e){
    var idOnibus = $(this).data("id-onibus");

    requestDeleteOnibus(idOnibus)

    window.location.href="/onibus/listar-todos"
});


function requestDeleteOnibus(idOnibus) {

    $.ajax({
        url: '/onibus/' +idOnibus,
        type: 'DELETE',
        success: function(result) {
            alert('removido com sucesso')
        }
    });
}