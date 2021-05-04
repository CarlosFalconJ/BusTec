$("#botao-logout").click(function (e) {
    e.preventDefault()

    mensagemConfirmacaoDeLogout('Deseja sair?', '/bustec/login');
});