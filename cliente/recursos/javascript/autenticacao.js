
//#region ***** Cadastro *****/
function cadastrar(e) {
    e.preventDefault();

    // Aqui, as divs que contêm a classe "invalid-feedback", serão obtidas pra verificar se tem algum conteúdo dentro delas.
    // Se for o caso, o cadastro não será feito e o usuário será notificado.

    var div_feedbacks_invalidos = document.getElementsByClassName('invalid-feedback');

    for (let i = 0; i < div_feedbacks_invalidos.length; i++) {
        var feedback = div_feedbacks_invalidos[i].innerHTML.trim();
        if (feedback) {
            notificar(false, 'Os dados informados não são válidos. Por favor, verifique os campos destacados.', '', 'error', '');
            return;
        }
    }
     
    notificar(true, 'Tudo ok!', 'Eviaremos um link de confirmação para o e-mail informado dentro de alguns instantes.', 'success', 'confirmacao-cadastro.html');
}

function aplicarMascaraRG(campo) {
    campo.value = campo.value.replace(/[^A-Z0-9.-]/g, ''); // Remove caracteres que não são letras maiúsculas nem números.
    $(`#${campo.id}`).mask("00.000.000-0");
}

function validarRG(rg) {
    rg = rg.replace(/[.-]/g, ''); // Remove os pontos (.) e o hífen (-).

    if (rg === "000000000") {
        return false;
    }

    if (rg.length < 8 || /^(.)\1+$/.test(rg)) { // Verifica se o RG tem menos de 8 dígitos (considerando RGs sem DV) e se não é uma sequência repetida qualquer.
        return false; 
    }

    return true;
}
//#endregion

//#region ***** Recuperação de senha *****/
function enviarCodigoRecuperacao(e) {
    e.preventDefault();

    var txtEmail = document.getElementById('txtEmailLogin').value;

    switch (txtEmail) {
        case 'hector.silva5@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        case 'diogo.martins5@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        case 'ellen.oliveira12@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        case 'enzo.silva9@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        case 'joao.garcia27@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        case 'henrique.cordeiro2@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        // Professores
        case 'humberto.toledo01@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        case 'joao.souza73@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        case 'rennan.araujo01@fatec.sp.gov.br':
            notificar(true, 'Enviamos o link para o e-mail informado!', 'Ao acessar o link, você será redirecionado para uma página onde poderá redefinir a sua senha.', 'success', '');
            break;
        default:
            notificar(false, 'Usuário não encontrado', '', 'error', '');
    }
}
//#endregion

//#region ***** Login *****/
function logar(e) {
    e.preventDefault();
    
    var txtEmail = document.getElementById('txtEmailLogin').value;
    var txtSenha = document.getElementById('txtSenhaLogin').value;

    switch (txtEmail) {
        case 'hector.silva5@fatec.sp.gov.br':
            txtSenha === 'hector.silva5' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        case 'diogo.martins5@fatec.sp.gov.br':
            txtSenha === 'diogo.martins5' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        case 'eduardo.urbano@fatec.sp.gov.br':
            txtSenha === 'eduardo.urbano' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        case 'ellen.oliveira12@fatec.sp.gov.br':
            txtSenha === 'ellen.oliveira12' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        case 'enzo.silva9@fatec.sp.gov.br':
            txtSenha === 'enzo.silva9' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        case 'joao.garcia27@fatec.sp.gov.br':
            txtSenha === 'joao.garcia27' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        // Professores
        case 'humberto.toledo01@fatec.sp.gov.br':
            txtSenha === 'humberto.toledo01' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        case 'joao.souza73@fatec.sp.gov.br':
            txtSenha === 'joao.souza73' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        case 'rennan.araujo01@fatec.sp.gov.br':
            txtSenha === 'rennan.araujo01' ? window.location.href = 'perfil-usuario.html' : notificar(false, 'E-mail ou senha incorretos.', 'Verifique as suas credenciais e tente novamente.', 'error', '');
            break;
        default:
            notificar(false, 'Usuário não cadastrado.', 'Cadastre-se e ganhe desconto de até 30% na primeira compra!', 'error', '');
    }
}
//#endregion