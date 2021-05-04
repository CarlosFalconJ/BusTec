$("#botao-login").click(function (e) {
    e.preventDefault();

    var username = $("#username").val();
    var senha = $("#password").val();

    var json = serializadorLogin(username, senha);

    postLogin(json)

});

function serializadorLogin(username, senha) {
    var dados =  {
        "usuario" : username,
        "senha" : senha
    }
    var json = JSON.stringify(dados);

    return json;
}

function postLogin(json){

        $.ajax({
            url: '/login',
            dataType: 'json',
            type: 'post',
            data: json,
        }).done(function () {
               menssagemDeSucesso('Bem vindo!!' ,'/')
            }).fail(function (){
                menssagemDeErro('Falha na autenticação!! Confira os dados e tente novamente');
            })
}
