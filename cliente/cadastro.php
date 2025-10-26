<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include '/componentes/head.php'; ?>
        <link rel="stylesheet" href="/cliente/recursos/css/autenticacao.css">
    </head>
	<body>
		<main class="container-autenticacao">
			<div class="logo_login">
				<img src="recursos/imagens/logos/AtelieFlorDoCerrado.png">
			</div>
			<form id="formCadastro" method="post" name="frmCadastroUsuario" class="form-auth form-cad fundo-blur" onsubmit="confirmarFormulario(event, 'formCadastro', 'cadastrar.php')">	
				<div class="form-auth-titulo">
					<h3>Crie a sua conta!</h3>
					<a class="btn-voltar-autenticacao" href="login.php">
						<i class="fa-solid fa-arrow-left"></i> Voltar
					</a>					
				</div>		

				<!-- Nome e CPF -->
				<div class="componentes-auth">
					<div class="campo-flutuante">
						<input id="txtNome" type="text" name="txt_nome" placeholder=" " onfocusout="validarNome('txtNome', 'txtNomeErro');" required>
						<label for="txtNome">Nome completo</label>
						<!-- <div id="txtNomeErro" class="invalid-feedback"></div> -->
					</div>
					<div class="campo-flutuante">
						<input id="txtCPF" type="text" onfocusout="validarCPF('txtCPF', 'txtCPFerro');" oninput="aplicarMascaraCPF(this);" maxlength="14" name="txt_cpf" placeholder=" " required>
						<label for="txtCPF">CPF</label>
						<!-- <div id="txtCPFerro" class="invalid-feedback"></div> -->
					</div>
				</div>

				<!-- Data de Nascimento e RG -->
				<div class="componentes-auth">
					<div class="campo-flutuante">
						<input id="dtNasc" type="date" onfocusout="validarDataNascimento('dtNasc', 'dtNascErro');" min="1900-01-01" max="2024-01-01" name="date" required>
						<label for="dtNasc">Nascimento</label>
						<!-- <div id="dtNascErro" class="invalid-feedback"></div> -->
					</div>

					<div class="campo-flutuante">
						<input id="txtRG" type="text" oninput="aplicarMascaraRG(this);" maxlength="12" name="txt_rg" placeholder=" " required>
						<label for="txtRG">RG</label>
						<!-- <div id="txtRGerro" class="invalid-feedback"></div> -->
					</div>
				</div>

				<!-- Telefone e E-mail -->
				<div class="componentes-auth">
					<div class="campo-flutuante">
						<input id="txtTelefone" type="tel" oninput="aplicarMascaraTelefone(this);" name="txt_telefone" placeholder=" " required>
						<label for="txtTelefone">Celular com DDD</label>
						<!-- <div id="txtTelefoneErro" class="invalid-feedback"></div> -->
					</div>

					<div class="campo-flutuante">
						<input id="txtEmail" type="email" onfocusout="validarEmail('txtEmail', 'txtEmailErro');" name="txt_email" placeholder=" " required>
						<label for="txtEmail">E-mail</label>
						<!-- <div id="txtEmailErro" class="invalid-feedback"></div> -->
					</div>

					<div class="campo-flutuante">
						<input id="txtConfirmarEmail" type="email" onfocusout="validarComparacaoCampos('txtEmail', 'txtConfirmarEmail', 'txtConfirmarEmailErro', 'Os e-mails não coincidem.');" autocomplete="off" name="txt_confirmar_email" placeholder=" " required>
						<label for="txtConfirmarEmail">Confirmar e-mail</label>
						<!-- <div id="txtConfirmarEmailErro" class="invalid-feedback"></div> -->
					</div>
				</div>

				<!-- Senha e Confirmar Senha -->
				<div class="componentes-auth">
					<div class="campo-flutuante">
						<input id="txtSenha" type="password" onfocusout="validarCriteriosSenha('txtSenha', 'txtSenhaErro');" name="txt_senha" placeholder=" " required>
						<label for="txtSenha">Senha</label>
						<!-- <div id="txtSenhaErro" class="invalid-feedback"></div> -->
					</div>

					<div class="campo-flutuante">
						<input id="txtConfirmarSenha" type="password" onfocusout="validarComparacaoCampos('txtSenha', 'txtConfirmarSenha', 'txtConfirmarSenhaErro', 'As senhas não coincidem.');" name="txt_confirmar_senha" placeholder=" " required>
						<label for="txtConfirmarSenha">Confirmar senha</label>
						<!-- <div id="txtConfirmarSenhaErro" class="invalid-feedback"></div> -->
					</div>	
				</div>
				
				<p class="texto-dica mb-3">
					A sua senha deve ter, no mínimo, 10 caracteres alfanuméricos, uma letra maiúscula e um caractere especial.
				</p>
				
				<!-- Botões -->
				<button id="btnCadastrar" type="submit" class="btn-confirmar">
					Cadastrar <i class="fa-solid fa-arrow-right mx-1"></i>
				</button>
			</form>
		</main>
	</body>
</html>