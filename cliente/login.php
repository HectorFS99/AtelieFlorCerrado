<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<?php include '/componentes/head.php'; ?>
		<link rel="stylesheet" href="/cliente/recursos/css/autenticacao.css">
		<script src="/cliente/recursos/javascript/autenticacao.js"></script>
	</head>
	<body>
		<main class="container-autenticacao">
			<div class="logo_login">
				<img src="recursos/imagens/logos/AtelieFlorDoCerrado.png">
			</div>			
			<form id="formLogin" name="logar" class="form-auth fundo-blur" onsubmit="document.logar.action='./acoes/logar.php'" method="post">
				<div class="form-auth-titulo">
					<h3>Bem-vindo(a)!</h3>
					<a class="btn-voltar-autenticacao" href="pagina-inicial.php">
						<i class="fa-solid fa-arrow-left"></i> 
						<span>Voltar</span>
					</a>					
				</div>
					
				<div class="campo-flutuante">
					<input id="txtEmailLogin" type="email" placeholder=" " name="txt_email" required>
					<label for="txtEmailLogin">E-mail</label>
				</div>
				<div class="campo-flutuante">
					<input id="txtSenhaLogin" type="password" placeholder=" " name="txt_senha" required>
					<label for="txtSenhaLogin">Senha</label>

					<i onclick="visualizarSenha('txtSenhaLogin');" class="fa-solid fa-eye-slash olho-senha"></i>
				</div>

				<div class="acoes-login">						
					<a class="link-autenticacao" href="esqueceu-senha.php">Esqueceu a senha?</a>
					<button id="btnEntrar" class="btn-confirmar" type="submit">
						Entrar <i class="fa-solid fa-arrow-right mx-1"></i>
					</button>
					<a href="cadastro.php" class="link-autenticacao border-0">
						Não tem uma conta? <b>Crie uma agora mesmo!</b>
					</a>
				</div>
			</form>
		</main>
	</body>
</html>