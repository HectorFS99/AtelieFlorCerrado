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
			<form class="form-auth fundo-blur" onsubmit="enviarCodigoRecuperacao(event);">
				<div class="form-auth-titulo">
					<h3>Recuperar</h3>
					<a class="btn-voltar-autenticacao" href="login.php">
						<i class="fa-solid fa-arrow-left"></i> 
						<span>Voltar</span>
					</a>					
				</div>	

				<h6 class="texto-info-recuperacao mb-4 text-center">Iremos enviar um link de segurança no e-mail informado.</h6>
				<div class="campo-flutuante">
					<input id="txtEmailLogin" type="email" placeholder=" " name="txt_email" required>
					<label for="txtEmailLogin">E-mail</label>
				</div>

				<button id="btnEntrar" class="btn-confirmar" type="submit">
					Confirmar <i class="fa-solid fa-arrow-right mx-1"></i>
				</button>
			</form>
		</main>
	</body>
</html>