<!DOCTYPE html>
<html lang="pt-br">
<?php include '/componentes/head.php'; ?>
<body>
	<?php include '/componentes/header_simples.php'; ?>
	<main class="container">
		<form id="formCadastro" method="post" name="Diogao" class="formulario w-100" onsubmit="confirmarFormulario(event, 'formCadastro', 'cadastrar.php')">	
			<h3 class="m-1 mt-5 mb-3">Cadastre-se</h1>
			<!-- Nome, Nasc., CPF e RG -->
			<div class="form-floating m-1">
				<input id="txtNome" type="text" class="form-control" placeholder="Nome completo" name="txt_nome"
					onfocusout="validarNome('txtNome', 'txtNomeErro');" 
					required>

				<label for="txtNome">Nome completo</label>
				<div id="txtNomeErro" class="invalid-feedback">
				</div>
			</div>
			<div class="d-flex flex-wrap">
				<div class="form-floating flex-fill m-1">
					<input onfocusout="validarDataNascimento('dtNasc', 'dtNascErro');" id="dtNasc" type="date" class="form-control" min="1900-01-01" max="2024-01-01" name="date" required>
					<label for="dtNasc">Data de nascimento</label>
					<div id="dtNascErro" class="invalid-feedback">
					</div>
				</div>
				<div class="form-floating flex-fill m-1">
					<input onfocusout="validarCPF('txtCPF', 'txtCPFerro');" oninput="aplicarMascaraCPF(this);" id="txtCPF" type="text" maxlength="14" class="form-control" placeholder="CPF" name="txt_cpf" required>
					<label for="txtCPF">CPF</label>
					<div id="txtCPFerro" class="invalid-feedback">
					</div>
				</div>
				<div class="form-floating flex-fill m-1">
					<input oninput="aplicarMascaraRG(this);" id="txtRG" type="text" maxlength="12" class="form-control" placeholder="RG" name="txt_rg" required>
					<label for="txtRG">RG</label>
					<div id="txtRGerro" class="invalid-feedback">
					</div>
				</div>
			</div>
			<!-- Contato e senha -->
			<h5 class="m-1 my-3">Contato</h5>
			<div class="d-flex flex-wrap">
				<div class="form-floating flex-fill m-1">
					<input oninput="aplicarMascaraTelefone(this);" id="txtTelefone" type="tel" class="form-control" placeholder="Telefone" name="txt_telefone" required>
					<label for="txtTelefone">Celular com DDD</label>
					<div id="txtTelefoneErro" class="invalid-feedback">
					</div>
				</div>
				<div class="form-floating flex-fill m-1">
					<input onfocusout="validarEmail('txtEmail', 'txtEmailErro');" id="txtEmail" type="email" class="form-control" placeholder="E-mail" name="txt_email" required>
					<label for="txtEmail">E-mail</label>
					<div id="txtEmailErro" class="invalid-feedback">
					</div>
				</div>
				<div class="form-floating flex-fill m-1">
					<input onfocusout="validarComparacaoCampos('txtEmail', 'txtConfirmarEmail', 'txtConfirmarEmailErro', 'Os e-mails não coincidem.');" id="txtConfirmarEmail" type="email" class="form-control" placeholder="Confirmar e-mail" autocomplete="off" name="txt_confirmar_email" required>
					<label for="txtConfirmarEmail">Confirmar e-mail</label>
					<div id="txtConfirmarEmailErro" class="invalid-feedback">
					</div>
				</div>
			</div>
			<div class="d-flex flex-wrap">
				<div class="flex-fill flex-sm-fill m-1">
					<div class="form-floating">
						<input onfocusout="validarCriteriosSenha('txtSenha', 'txtSenhaErro');" id="txtSenha" type="password" class="form-control" placeholder="Senha" name="txt_senha" required>
						<label for="txtSenha">Senha</label>
					</div>
					<div id="txtSenhaErro" class="invalid-feedback">
					</div>
				</div>
				<div class="form-floating flex-fill m-1">
					<input onfocusout="validarComparacaoCampos('txtSenha', 'txtConfirmarSenha', 'txtConfirmarSenhaErro', 'As senhas não coincidem.');" id="txtConfirmarSenha" type="password" class="form-control" placeholder="Confirmar senha" name="txt_confirmar_senha" required>
					<label for="txtConfirmarSenha">Confirmar senha</label>
					<div id="txtConfirmarSenhaErro" class="invalid-feedback">
					</div>
				</div>
			</div>
			<small class="form-text text-muted m-1"> A sua senha deve ter, no mínimo, 10 caracteres alfanuméricos, uma letra maiúscula e um caractere especial. </small>
			<!-- Botões -->
			<div class="d-flex justify-content-end flex-wrap mt-3 mb-5">
				<a href="login.php" class="btn btn-lg btnCancelar m-1 flex-fill"><strong>Cancelar</strong></a>
				<button id="btnCadastrar" type="submit" class="btn btn-lg btnCadastrar m-1 flex-fill"><strong>Cadastrar</strong></button>
			</div>
		</form>
	</main>
</body>

</html>