$("#salvar-ponto-atualizar").click(function (e) {
    e.preventDefault()

    let id = window.location.href;
    id = id.split('/');
    let idPonto = id[5]

    var nome= $("#nome_ponto-atualizar").val();
    var bairro = $("#bairro_ponto-atualizar").val();
    var rua = $("#rua_ponto-atualizar").val();
    var ponto_referencia = $("#ponto_ref_ponto-atualizar").val();

    var json = serializadorPonto(nome, bairro, rua, ponto_referencia);
    realizaRequestAtualizaPonto(idPonto, json);
});

function realizaRequestAtualizaPonto(idPonto, json) {
    $.ajax({
        type: 'PUT',
        url: '/ponto/' + idPonto,
        contentType: 'application/json',
        data: json
    }).done(function () {
        menssagemDeSucesso('Ponto atualizado com sucesso!!', '/ponto/listar-todos')
    }).fail(function () {
        menssagemDeErro('Ponto não atualizado!!, verifique os dados e tente novamente')
    });
}

$("#limpar-ponto-atualizar").click( function (e) {
    e.preventDefault();

    $("#nome_ponto-atualizar").val("");
    $("#bairro_ponto-atualizar").val("");
    $("#rua_ponto-atualizar").val("");
    $("#ponto_ref_ponto-atualizar").val("");
})