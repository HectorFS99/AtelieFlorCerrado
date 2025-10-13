function transformarTabela(id_tabela) {
    if ($.fn.dataTable.isDataTable(id_tabela)) {
        $(id_tabela).DataTable().destroy();
    }
 
    let table = new DataTable(id_tabela, {
        language: {
            search: ""
            , searchPlaceholder: "Buscar..."
            , lengthMenu: "Exibir _MENU_ itens por página"
            , info: "Exibindo _END_ de _TOTAL_ registro(s)"
            , infoEmpty: ""
            , "paginate": {
                 "first": "Primeiro"
                 , "last": "Último"
                 , "next": "<i class=\"fa-solid fa-angle-right\"></i>"
                 , "previous": "<i class=\"fa-solid fa-angle-left\"></i>"
            }
            , zeroRecords: "Nenhum registro encontrado."
            , emptyTable: "Não existem dados a serem exibidos."
            , thousands: "."
            , decimal: ","
            , infoFiltered: ""
        }
    });
}

/* * * * * SweetAlert2. * * * * */
// Popups
const popupSwal = Swal.mixin({
    customClass: {
        confirmButton: 'btn btn-lg btn-light custom-button-popup'
        , cancelButton: 'btn btn-lg btn-danger custom-button-popup'
        , popup: 'custom-popup'
    },
    buttonsStyling: false
});
 
// Toasts
const toastSwal = Swal.mixin({
    toast: true,
    position: 'top-end',
    iconColor: 'white',
    customClass: {
        popup: 'colored-toast',
    },
    showConfirmButton: false,
    timer: 7000,
    timerProgressBar: true,
});

// Caso 'popup' seja passado como 'true', será exibido um POPUP. Caso 'false', será exibido um TOAST.
function notificar(popup, titulo, mensagem, icone, caminho) {
    if (popup) {
        popupSwal.fire({
            title: `${titulo}`
            , text: `${mensagem}`
            , icon: `${icone}`
        }).then(() => {
            if (caminho) { window.location.href = `${caminho}`; }
        })
    } else {
        toastSwal.fire({
            title: `${titulo}`
            , text: `${mensagem}`
            , icon: `${icone}`
        });
    }
}

/* * * * * Requisições * * * * */
function adicionarRegistro(event, id_form, url, linkRedirecionamento = '/adm_index.php') {
    event.preventDefault();

    if (verificarFeedbackInvalido(id_form)) {
        notificar(false, "Atenção", "Um ou mais dados informados não são válidos.", "warning", "");
        return;
    }

    const form = document.getElementById(id_form);
    const dadosFormulario = new FormData(form);

    $.ajax({
        url: url,
        method: 'POST',
        data: dadosFormulario,
        processData: false,
        contentType: false,
        success: function (retorno) {
            console.log(retorno);
            notificar(true, "Sucesso!", "O registro foi adicionado com sucesso.", 'success', linkRedirecionamento);
        },
        error: function (retorno) {
            console.error(retorno);

            let mensagem = "Não foi possível adicionar o registro.";
            if (retorno.responseText) {
                mensagem = retorno.responseText;
            }

            notificar(true, "Erro", mensagem, 'error', '');
        }
    });
}

/* * * * * Autenticação * * * * */
function autenticar(event) {
    event.preventDefault();

    const form = document.getElementById('formLogin');
    const dadosFormulario = new FormData(form);

    $.ajax({
        url: 'http://localhost:8080/usuarios/autenticar',
        method: 'POST',
        data: dadosFormulario,
        processData: false,
        contentType: false,
        success: function (retorno) {                    
            sessionStorage.setItem('usuarioLogado', JSON.stringify(retorno));
            notificar(true, "Acesso autorizado!", "Você será redirecionado(a) para a página principal.", 'success', 'adm_index.php');
        },
        error: function (retorno) {
            console.error(retorno);

            let mensagem = "Ocorreu um erro ao autenticar você.";
            if (retorno.responseText) {
                mensagem = retorno.responseText;
            }

            notificar(true, "Erro", mensagem, 'error', '');
        }
    });
}

function deslogar(nomeSessao) {
    sessionStorage.removeItem(nomeSessao);
    window.location.href = 'adm_login.php';
}