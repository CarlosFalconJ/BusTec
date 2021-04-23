
function menssagemDeErro(texto) {
    iziToast.error({
        timeout: 3500,
        position: 'topCenter',
        title: 'Erro',
        message: texto,
        buttons: [
            ['<button>Ok</button>',function (instance, toast){
                instance.hide({
                    transaction: 'fadeOutUp',
                    onClosing:function (instance, toast,closedBy) {
                    }
                },toast, 'buttonName');
            },true]
        ],
        onClosing: function () {
        }
    });
    $(document).on('iziToast-close', function (){
    });
}

function menssagemDeSucesso(texto, url) {
    iziToast.success({
        timeout: 3500,
        position: 'topCenter',
        title: 'Sucesso',
        message: texto,
        buttons: [
            ['<button>Ok</button>',function (instance, toast){
                instance.hide({
                    transaction: 'fadeOutUp',
                    onClosing:function (instance, toast,closedBy) {
                        window.location.href = url;
                    }
                },toast, 'buttonName');
            },true]
        ],
        onClosing: function () {
            window.location.href = url;
        }
    });
    $(document).on('iziToast-close', function (){
        window.location.reload();
    });
}

function menssagemDeExcluir(texto) {
    iziToast.success({
        timeout: 3500,
        position: 'topCenter',
        title: 'Sucesso',
        message: texto,
        buttons: [
            ['<button>Ok</button>',function (instance, toast){
                instance.hide({
                    transaction: 'fadeOutUp',
                    onClosing:function (instance, toast,closedBy) {
                        window.location.reload();
                    }
                },toast, 'buttonName');
            },true]
        ],
        onClosing: function () {
            window.location.href.reload();
        }
    });
    $(document).on('iziToast-close', function (){
        window.location.reload();
    });
}
