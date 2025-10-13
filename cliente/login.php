<!DOCTYPE html>
<html lang="pt-br">
	<?php include '/componentes/head.php'; ?>
	<body>
   	    <?php include '/componentes/header_simples_2.php'; ?>
		<main class="container">
			<form id="formLogin" class="formulario" name="logar" onsubmit="document.logar.action='./acoes/logar.php'" method="post">
				<div class="logo_login">
					<img src="recursos/imagens/logos/logo_futureMob.png">
				</div>
				<!-- <h3 class="mb-3">Acesse a sua conta</h1> -->
				<div class="form-floating">
					<input id="txtEmailLogin" type="email" class="form-control" placeholder="Email" name="txt_email" required>
					<label for="txtEmailLogin">Email</label>
				</div>
				<div class="form-floating">
					<input id="txtSenhaLogin" type="password" class="form-control" placeholder="Senha" name="txt_senha" required>
					<label for="txtSenhaLogin">Senha</label>
					<i onclick="visualizarSenha('txtSenhaLogin');" class="fa-solid fa-eye-slash olho-senha"></i>
				</div>
				<div class="my-1">
					<a class="text-start text-decoration-none" href="esqueceu-senha.php">Esqueceu a senha?</a>
				</div>
				<div class="btn-group-vertical w-100 mt-2">
					<button id="btnEntrar" class="btn btn-lg" type="submit">Entrar</button>
					<a href="cadastro.php" class="btn btn-lg btnCadastrar">Ou cadastre-se</a>
				</div>
			</form>
		</main>
	</body>
</html>