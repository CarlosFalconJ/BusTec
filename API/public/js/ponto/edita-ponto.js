$("#atualizar-ponto").ready(function () {
    $("#nome_ponto-atualizar").val(localStorage.getItem('nome_ponto-atualizar'));
    $("#bairro_ponto-atualizar").val(localStorage.getItem('bairro_ponto-atualizar'));
    $("#rua_ponto-atualizar").val(localStorage.getItem   ('rua_ponto-atualizar'));
    $("#ponto_ref_ponto-atualizar").val(localStorage.getItem('ponto_referencia-atualizar'));
})


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
        url: 'http://localhost:8080/ponto/' + idPonto,
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