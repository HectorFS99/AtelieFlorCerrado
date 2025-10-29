document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('btnHamburguer');
    const menu = document.getElementById('menu-superior');

    btn.addEventListener('click', function () {
        const aberto = menu.classList.toggle('aberto');
        btn.setAttribute('aria-expanded', aberto ? 'true' : 'false');
    });

    // fecha ao clicar em um link do menu
    menu.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', function () {
            menu.classList.remove('aberto');
            btn.setAttribute('aria-expanded', 'false');
        });
    });

    // garante estado correto ao redimensionar
    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            menu.classList.remove('aberto');
            btn.setAttribute('aria-expanded', 'false');
        }
    });
});

//#region ***** Máscaras para campos (pode ser usada em outras telas) *****/
function aplicarMascaraCPF(campo) {
    campo.value = campo.value.replace(/[^0-9.-]/g, ''); // Remove letras e mantém apenas números, ponto (.) e hífen (-).
    $(`#${campo.id}`).mask("000.000.000-00");
}

function aplicarMascaraTelefone(campo) {
    $(`#${campo.id}`).mask("(00) 00000-0000");
}

function aplicarMascaraNumeroCartao(campo) {
    campo.value = campo.value.replace(/[^0-9 ]/g, ''); // Remove letras e mantém apenas números, ponto (.) e hífen (-).
    $(`#${campo.id}`).mask("0000 0000 0000 0000");
}

function aplicarMascaraValidadeCartao(campo) {
    campo.value = campo.value.replace(/[^0-9/]/g, ''); // Remove letras e mantém apenas números, ponto (.) e hífen (-).
    $(`#${campo.id}`).mask("00/0000");
}

function aplicarMascaraCodigoSeguranca(campo) {
    campo.value = campo.value.replace(/[^0-9/]/g, ''); // Remove letras e mantém apenas números, ponto (.) e hífen (-).
}
//#endregion

//#region ***** Validações *****/
function validarCaracteresEspeciais(texto) {
    return /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/.test(texto);
}

function validarComparacaoCampos(id_campo, id_campo_confirmacao, id_feedback, mensagem) {
    var campo = document.getElementById(id_campo);
    var campo_confirmacao = document.getElementById(id_campo_confirmacao);

    var div_feedback = document.getElementById(id_feedback);

    campo.value !== campo_confirmacao.value ? exibirFeedback(campo, div_feedback, mensagem) : limparFeedback(div_feedback);
}

function validarCriteriosSenha(id_campo, id_feedback) {
    var campo = document.getElementById(id_campo);
    var div_feedback = document.getElementById(id_feedback);

    !/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=])[A-Za-z\d!@#$%^&*()-_+=]{10,}$/.test(campo.value) ? exibirFeedback(campo, div_feedback, 'Esta senha não atende aos critérios de segurança.') : limparFeedback(div_feedback);
}

function validarNome(id_campo, id_feedback) {
    var campo = document.getElementById(id_campo);
    var div_feedback = document.getElementById(id_feedback);

    if (campo.value.length < 2) {
        exibirFeedback(campo, div_feedback, 'Nome inválido. Informe-o corretamente.')
    } else if (validarCaracteresEspeciais(campo.value)) {
        exibirFeedback(campo, div_feedback, 'Não são permitidos caracteres especiais. Informe um nome válido.');
        campo.value = '';
    } else {
        limparFeedback(div_feedback);
    }    
}

function validarDataNascimento(id_campo, id_feedback) {
    var campo = document.getElementById(id_campo);
    var div_feedback = document.getElementById(id_feedback);

    var dtNasc = new Date(campo.value)
        , mesNasc = dtNasc.getMonth() + 1 // Dado que os meses aqui são índices, começando por 0, acrescentei +1
        , dtAtual = new Date()
        , mesAtual = dtAtual.getMonth() + 1
        , idade = dtAtual.getFullYear() - dtNasc.getFullYear();
    
    if (mesAtual < mesNasc || (mesAtual === mesNasc && dtAtual.getDate() < dtNasc.getDate())) { idade--; }

    idade < 18 ? exibirFeedback(campo, div_feedback, 'É necessário ser maior de idade para realizar o cadastro.') : limparFeedback(div_feedback);    
}

function validarCPF(id_campo, id_feedback) {
    var campo = document.getElementById(id_campo);
    var div_feedback = document.getElementById(id_feedback);

    var cpf = campo.value.replace(/[.-]/g, ''); // Remove os pontos (.) e o hífen (-), mantendo apenas números para realizar as operações de validação.

    if (cpf == "00000000000") {
        exibirFeedback(campo, div_feedback, 'Informe um CPF válido.');
        return;
    }

    if (cpf.length !== 11 || /^(.)\1+$/.test(cpf)) { // Verifica se o CPF tem 11 dígitos e se não é uma sequência repetida qualquer.
        exibirFeedback(campo, div_feedback, 'Informe um CPF válido.');
        return; 
    }
    
    var soma;
    var resto;
    soma = 0;

    for (i = 1; i <= 9; i++) {
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i); 
    }

    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) { 
        resto = 0; 
    }
    if (resto != parseInt(cpf.substring(9, 10))) {
        exibirFeedback(campo, div_feedback, 'Informe um CPF válido.');
        return;
    }

    soma = 0;
    for (i = 1; i <= 10; i++) { 
        soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i); 
    }

    resto = (soma * 10) % 11;
    if ((resto == 10) || (resto == 11)) {
        resto = 0;        
    }
    if (resto != parseInt(cpf.substring(10, 11) )) {
        exibirFeedback(campo, div_feedback, 'Informe um CPF válido.');
        return;
    }

    limparFeedback(div_feedback);
}

function validarEmail(id_campo, id_feedback) {
    var campo = document.getElementById(id_campo);
    var div_feedback = document.getElementById(id_feedback);

    !/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(?:\.[a-zA-Z]{2,})?$/.test(campo.value) ? exibirFeedback(campo, div_feedback, 'Informe um e-mail válido.') : limparFeedback(div_feedback);
}

function impedirColagem(e) { // Impede que o usuário cole conteúdos em um determinado campo. EXEMPLO: Campo de confirmação de e-mail e senha.
    e.preventDefault();
    var clipboardData = e.clipboardData || window.clipboardData;
    clipboardData.setData('text', '');
}

function validarDataExpiracao(id_campo, id_feedback) {
    var campo = document.getElementById(id_campo);
    var div_feedback = document.getElementById(id_feedback);

    var posBarra = campo.value.indexOf('/');
    var mes = parseInt(campo.value.substring(0, posBarra));
    var ano = parseInt(campo.value.substring(posBarra + 1));
    
    if (mes > 12 || (ano > 2043 || ano < new Date().getFullYear())) {
        exibirFeedback(campo, div_feedback, 'Data inválida. Informe a validade corretamente.')
    } else {
        limparFeedback(div_feedback);
    }
}
//#endregion

//#region ***** Feedback *****/
function exibirFeedback(campo, div_feedback, mensagem) {
    div_feedback.style.display = 'block';
    div_feedback.innerHTML = `<strong>${mensagem}</strong>`;

    //campo.focus();
}

function limparFeedback(div_feedback) {
    div_feedback.innerHTML = '';
    //div_feedback.style.display = 'none';
}

function verificarFeedbackInvalido(id_form) {
    var formulario = document.getElementById(id_form);
    var feedbacks = formulario.querySelectorAll(".invalid-feedback");
    
    for (let i = 0; i < feedbacks.length; i++) {
        if (feedbacks[i].textContent.trim() !== "") {
            return true;
        }
    }
    
    return false;
}

function confirmarFormulario(event, id_form, caminho_action) {
    event.preventDefault();

    if (verificarFeedbackInvalido(id_form)) {
        notificar(false, "Verifique as suas informações", "Um ou mais dados informados não são válidos.", "error", "");
        return;
    } else {
        var formulario = document.getElementById(id_form);
        formulario.action = caminho_action;
        formulario.submit();    
    }
}
//#endregion

//#region ***** Valores *****/
function calcularSubtotal(name_lbl_valor, name_lbl_qtd, id_lbl_subTotal) {
    var listaProdutosPreco = document.querySelectorAll(`[name="${name_lbl_valor}"]`);
    var listaProdutosQtd = document.querySelectorAll(`[name="${name_lbl_qtd}"]`);

    var subTotal = 0;
    for (let i = 0; i < listaProdutosPreco.length; i++) {
        var subTotalTexto = listaProdutosPreco[i].textContent.trim();        
        var qtd = parseInt(listaProdutosQtd[i].textContent.trim());

        subTotal += parseFloat((subTotalTexto.replace(/\./g, '').replace(',', '.')) * qtd);
    }

    document.getElementById(id_lbl_subTotal).innerHTML = `${formatarValor(subTotal)}`;

    return subTotal;
}

function formatarValor(valor) {
    return new Intl.NumberFormat('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(valor);
}

function adicionarQtd(id_componente_qtd, name_lbl_valor, name_lbl_qtd, id_lbl_subTotal) {
    var qtd = parseInt(document.getElementById(id_componente_qtd).innerHTML) + 1;
    document.getElementById(id_componente_qtd).innerHTML = qtd;

    calcularSubtotal(name_lbl_valor, name_lbl_qtd, id_lbl_subTotal);
}

function subtrairQtd(id_componente_qtd, name_lbl_valor, name_lbl_qtd, id_lbl_subTotal) {
    var componente = document.getElementById(id_componente_qtd);
    var qtd = parseInt(componente.innerHTML);

    qtd > 1 ? componente.innerHTML = qtd - 1 : componente.innerHTML = componente.innerHTML;

    calcularSubtotal(name_lbl_valor, name_lbl_qtd, id_lbl_subTotal);
}

function formatarParaDecimal(valorStr) {
    let valorFormatado = valorStr.replace('.', '').replace(',', '.');
    return parseFloat(valorFormatado);
}
//#endregion

//#region ***** Busca por CEP *****/
function pesquisaCep(id_componente_cep) {
    var componente_cep = document.getElementById(id_componente_cep);
    var cep = componente_cep.value.replace(/\D/g, '');

    if (cep) {
        var validacep = /^[0-9]{8}$/;      
        if(validacep.test(cep)) {
            var script = document.createElement('script');
            script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=dados_cep';
            
            document.body.appendChild(script);
        } else {
            componente_cep.value = '';
            notificar(false, 'CEP inválido', 'Informe um CEP válido para consulta.', 'error', '');
        }
    } else { componente_cep.value = ''; }    
}

function dados_cep(conteudo) {
    var campo = document.getElementById('txtCep');
    var feedback = document.getElementById('txtCepErro');

    if (!("erro" in conteudo)) {
        var container = document.getElementById('resultado-frete');

        var logradouro = document.getElementById('resultado-cep_logradouro'); // Endereço
        var bairro = document.getElementById('resultado-cep_bairro');
        var localidade = document.getElementById('resultado-cep_cidade'); // Cidade
        var uf = document.getElementById('resultado-cep_uf');

        logradouro.innerHTML = logradouro.value = conteudo.logradouro;
        bairro.innerHTML = bairro.value = conteudo.bairro;
        localidade.innerHTML = localidade.value = conteudo.localidade;
        uf.innerHTML = uf.value = conteudo.uf;  

        if (container) { container.style.display = 'block'; }

        limparFeedback(feedback);
    } else {
        campo.value = '';
        exibirFeedback(campo, feedback, 'Informe um CEP válido.');

        notificar(false, 'CEP não encontrado', '', 'error', '');
    }
}
//#endregion 

//#region ***** Outros *****/
function visualizarSenha(id_campo) {
    var campo_senha = document.getElementById(id_campo);
    var botao_visualizar = document.querySelector('.olho-senha');

    if (campo_senha.type === 'password') {
        campo_senha.type = 'text';
        botao_visualizar.classList.replace('fa-eye-slash', 'fa-eye');
    } else {
        campo_senha.type = 'password';
        botao_visualizar.classList.replace('fa-eye', 'fa-eye-slash');
    }    
}
//#endregion

//#region ***** ***** ***** detalhes-produto.js ***** ***** *****/
function adicionarAoCarrinho() {
    notificar(false, 'Produto adicionado!', '', 'success', '');

    var contador;
    var quantidade = parseInt(document.getElementById('qtdProd2').innerHTML);
    if (quantidade > 1) {
        contador = parseInt(document.getElementById('contador-obj').innerHTML) + quantidade;
    } else {
        contador = parseInt(document.getElementById('contador-obj').innerHTML) + 1;
    }

    document.getElementById('contador-obj').innerHTML = contador;
}

function indisponivel() {
    var grupoBotoes = document.getElementById('grpBtnAcoes');
    var btnIndisponivel = document.getElementById('btnAviseMe');
    var quantidade = document.getElementById('div-qtd');

    quantidade.style.display = 'none';
    grupoBotoes.style.display = 'none';
    btnIndisponivel.style.display = 'block';
}

function disponivel() {
    var grupoBotoes = document.getElementById('grpBtnAcoes');
    var btnIndisponivel = document.getElementById('btnAviseMe');
    var quantidade = document.getElementById('div-qtd');

    quantidade.style.display = 'block';
    grupoBotoes.style.display = 'flex';
    btnIndisponivel.style.display = 'none';
}

function avisarQuandoChegar() {
    popupSwal.fire({ 
        title: `Em qual e-mail você deseja ser notificado?`
        , icon: 'question'
        , html: `
        <div class="form-floating">
            <input id="txtEmailAviso" type="email" class="form-control" placeholder="Email" required>
            <label for="txtEmailAviso">Email</label>
        </div>`
        , showCancelButton: true
        , confirmButtonText: "OK"
        , cancelButtonText: "Cancelar"
        , reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var email = document.getElementById('txtEmailAviso').value;
            if (email) {
                notificar(true, "Obrigado!", "Iremos enviar um e-mail assim que este produto estiver disponível.", "success", '');
            } else {
                popupSwal.fire({ 
                    title: "Por favor, informe um e-mail para ser notificado."
                    , icon: "warning"
                    , confirmButtonText: "OK"
                }).then(() => {
                    avisarQuandoChegar();
                });
            }        
        }
    });
}
//#endregion

//#region ***** ***** ***** pedidos.js ***** ***** *****/
function finalizarPedido(e) {
    e.preventDefault();

    var opcaoEntrega = document.querySelector('input[name="opcao-entrega"]:checked');
    var formaPagamento = document.querySelector('input[name="forma-pagamento"]:checked');

    if (!opcaoEntrega || !formaPagamento) {
        notificar(false, 'Escolha uma opção de entrega e uma forma de pagamento.', '', 'error', '');
        return;
    } else {
        var creditoDebito = document.querySelector('input[name="credito_debito"]:checked');

        if (formaPagamento.value !== 'pix' && !creditoDebito) {
            notificar(false, 'Escolha uma opção de pagamento para o cartão selecionado (crédito ou débito).', '', 'error', '');
            return;           
        } else if (formaPagamento.value !== 'pix') {
            document.getElementById('txtCreditoDebito').value = creditoDebito.value;
            
            var parcelas = document.getElementById('cboParcelas').value;
            document.getElementById('txtParcelas').value = parcelas;
        }
        
        var subTotal = formatarParaDecimal(document.getElementById('lblValorSubTotalPedido').innerText);
        var frete = formatarParaDecimal(document.getElementById('lblValorFrete').innerText);
        var desconto = formatarParaDecimal(document.getElementById('lblValorDesconto').innerText);
        var total = formatarParaDecimal(document.getElementById('lblValorTotalPedido').innerText);
        
        document.getElementById('txtFormaPagamento').value = formaPagamento.value;
        document.getElementById('txtValorSubTotalPedido').value = subTotal;
        document.getElementById('txtValorFrete').value = frete;
        document.getElementById('txtValorDesconto').value = desconto;
        document.getElementById('txtValorTotalPedido').value = total;
        document.getElementById('txtOpcaoEntrega').value = opcaoEntrega.value;

        var formulario = document.getElementById('frmFinalizarPedido');
        formulario.action = 'acoes/pedidos/cadastrar_pedido.php';
        formulario.submit();  
    }  
}

function avaliar() {
    popupSwal.fire({ 
        title: `O que você achou?`
        , icon: 'question'
        , html: `
        <section>
            <div id="radio-2" class="star-rate">
                <input type="radio" id="star-check-1" class="star-check" name="stars-2" />
                <input type="radio" id="star-check-2" class="star-check" name="stars-2" />
                <input type="radio" id="star-check-3" class="star-check" name="stars-2" />
                <input type="radio" id="star-check-4" class="star-check" name="stars-2" />
                <input type="radio" id="star-check-5" class="star-check" name="stars-2" />
                <div class="stars">
                    <label for="star-check-1"><i data-star-value="1" class="fa fa-star"></i></label>
                    <label for="star-check-2"><i data-star-value="2" class="fa fa-star"></i></label>
                    <label for="star-check-3"><i data-star-value="3" class="fa fa-star"></i></label>
                    <label for="star-check-4"><i data-star-value="4" class="fa fa-star"></i></label>
                    <label for="star-check-5"><i data-star-value="5" class="fa fa-star"></i></label>
                </div>
            </div>
        </section>
        <div class="mb-3">
            <textarea id="txtComentario" rows="3"></textarea>
        </div>
        <small>
            A sua avaliação será revisada pela nossa equipe, antes de ficar visível para o público.
        </small>`
        , showCancelButton: true
        , confirmButtonText: "OK"
        , cancelButtonText: "Cancelar"
        , reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var algumRadioMarcado = document.querySelector('input[name="stars-2"]:checked') !== null;
            if (algumRadioMarcado) {
                popupSwal.fire("Obrigado por avaliar!", "A sua avaliação será analisada. Iremos te avisar via e-mail quando estiver publicada.", "success");

                var btnAvaliar = document.getElementById('btnAvaliar');
                btnAvaliar.innerHTML = 'Avaliação em análise';
                
                btnAvaliar.classList.replace('btn-detalhes_ped', 'btn-secondary');
                btnAvaliar.classList.add('disabled');
            } else {
                popupSwal.fire({ 
                    title: "Por favor, selecione alguma estrela."
                    , icon: "warning"
                    , confirmButtonText: "OK"
                }).then(() => {
                    avaliar();
                });
            }        
        }
    });
}

function acompanharEntrega() {
    popupSwal.fire({ 
        title: `Previsão de Entrega: <b>10/06/2024</b>`
        , icon: ''
        , html: `
        <section>
            <ul class="d-flex flex-column">
                <li class="acp-entrega_etapa d-flex">
                    <i class="fa-solid fa-house-circle-check"></i>
                    <small>O pedido foi entregue ao destinatário.</small>
                </li>
                <li class="acp-entrega_linha"></li>
                <li class="acp-entrega_etapa acp-entrega_sucesso_etapa">
                    <i class="fa-solid fa-truck-fast"></i>
                    <small>Quase lá! O seu pedido está em rota de entrega.</small>
                </li>
                <li class="acp-entrega_linha acp-entrega_sucesso_linha"></li>
                <li class="acp-entrega_etapa acp-entrega_sucesso_etapa">
                    <i class="fa-solid fa-truck-ramp-box"></i>
                    <small>O seu pedido está sendo preparado para transporte.</small>
                </li>
                <li class="acp-entrega_linha acp-entrega_sucesso_linha"></li>
                <li class="acp-entrega_etapa acp-entrega_sucesso_etapa">
                    <i class="fa-solid fa-dolly"></i>
                    <small>O pedido foi recolhido pela transportadora.</small>
                </li>
                <li class="acp-entrega_linha acp-entrega_sucesso_linha"></li>
                <li class="acp-entrega_etapa acp-entrega_sucesso_etapa">
                    <i class="fa-solid fa-arrow-up"></i>
                    <small>Enviamos o seu pedido para transportadora.</small>
                </li>
            </ul>
        </section>`
        , confirmButtonText: "OK"
    });    
}
//#endregion