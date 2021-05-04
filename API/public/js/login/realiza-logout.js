$("#botao-logout").click(function (e) {
    e.preventDefault()

    mensagemConfirmacaoDeLogout('Deseja fazer logout?', '/bustec/login');
});