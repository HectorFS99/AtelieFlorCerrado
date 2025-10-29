<?php
	header('Content-Type: text/html; charset=utf-8');
?>
	<html lang="pt-br">
		<head>
			<?php include '/componentes/head.php'; ?>
			<link rel="stylesheet" href="/blog/recursos/css/pagina-inicial.css">
		</head>	
		<body>
			<?php include '/componentes/header.php'; ?>
			<main>
				<!-- Início -->
				<section id="section-inicio">
					<div class="div_inicio">
						<div class="div_inicio_infos">
							<div class="">
								<h1 class="titulo">Ateliê Flor do Cerrado</h1>
								<h4 class="subtitulo">A loja número 1 em bolsas artesanais no Brasil e no Mundo.</h4>
							</div>
							<a href="../cliente/pagina-inicial.php" class="btn btn-lg btn-gradiente">
								Conheça nossa loja
							</a>
						</div>
						<img width="400px" src="./recursos/imagens/produtos/sophie.png" alt="Bolsa artesanal feita com palha">
					</div>
				</section>

				<!-- Últimas postagens -->
				<section class="secao">
					<div class="secao-titulo-subtitulo">
						<h2 class="titulo-secao">Últimas postagens</h2>
						<div class="link-card">
						<a href="./artigos/moda-sustentavel.php" class="card_conteudo">
							<img src="./recursos/imagens/artigos/moda-artesanal.jpg" class="card-produto_img" alt="Linhas de crochê e fibras naturais usadas na confecção de bolsas artesanais" />
							<div class="card_conteudo_texto">
								<h5>Moda sustentável</h5>
								<p>Por que escolher peças artesanais?</p>
							</div>
						</a>
						<a href="./artigos/estilo.php" class="card_conteudo">
							<img src="./recursos/imagens/modelos/mulher-chapeu-palha.png" class="card-produto_img" alt="Mulher usando bolsa artesanal com look urbano"/>
							<div class="card_conteudo_texto">
								<h5>Estilo</h5>
								<p>Como combinar bolsas artesanais com diferentes estilos</p>
							</div>
						</a>
						<a href="./artigos/cuidados.php" class="card_conteudo">
							<img src="./recursos/imagens/artigos/cuidados-home.avif" class="card-produto_img" alt="Bolsas artesanais feita de fibras naturais e/ou linha de algodão" />
							<div class="card_conteudo_texto">
								<h5>Cuidados</h5>
								<p>5 dicas para cuidar da sua bolsa de fibras naturais</p>
							</div>
						</a>
					</div>
					
				</section>

				<!-- Closet Virtual -->
				<section class="secao proximo-lancamento">
					<img src="./recursos/imagens/produtos/bianca.png" alt="">
					<div class="proximo-lancamento-info">
						<div class="secao-titulo-subtitulo" style="align-items: start;">
							<h2 class="titulo-secao">Closet Virtual</h2>
							<h4 class="subtitulo-secao" style="text-align: start;">
								Uma nova coleção está florescendo...<br>
								Fique de olho: em breve, novas peças exclusivas chegarão ao ateliê.
							</h4>
						</div>
						<div>
							<div class="contador-lancamento">
								<div class="caixa-contador">
									<h3>06</h3>
									<p>Dias</p>
								</div>
								<div class="caixa-contador">
									<h3>18</h3>
									<p>Horas</p>
								</div>
								<div class="caixa-contador">
									<h3>48</h3>
									<p>Min.</p>
								</div>
							</div>

							<a href="listagem-geral-produtos.php" class="btn btn-lg btn-gradiente">
								SAIBA MAIS
							</a>
						</div>
					</div>
				</section>

				<!-- Dicas & Inspirações -->
				<section class="secao">
					<div class="secao-titulo-subtitulo">
						<h2 class="titulo-secao">Dicas & Inspirações</h2>
						<h4 class="subtitulo-secao">
							Mais do que bolsas, o Ateliê Flor do Cerrado compartilha histórias, inspirações e cuidados para você viver a moda artesanal de forma consciente e autêntica.
						</h4>
					</div>
					<div class="link-card">
						<a href="#" class="card_conteudo">
							<img src="./recursos/imagens/modelos/mulher-vermelho.png" class="card-produto_img" alt="..." />
							<div class="card_conteudo_texto">
								<h5>Outerwear</h5>
								<p>Moda sustentável: por que escolher peças artesanais?</p>
							</div>
						</a>
						<a href="#" class="card_conteudo">
							<img src="./recursos/imagens/modelos/mulher-chapeu-palha.png" class="card-produto_img" alt="..." />
							<div class="card_conteudo_texto">
								<h5>Estilo</h5>
								<p>Como combinar bolsas artesanais com diferentes estilos</p>
							</div>
						</a>
						<a href="#" class="card_conteudo">
							<img src="./recursos/imagens/modelos/mulher-jaqueta-couro.jpg" class="card-produto_img" alt="..." />
							<div class="card_conteudo_texto">
								<h5>Cuidados</h5>
								<p>5 dicas para cuidar da sua bolsa de fibras naturais</p>
							</div>
						</a>
					</div>
				</section>

				<!-- Feedbacks -->
				<section class="secao custom-main">				
					<div class="secao-titulo-subtitulo">
						<h2 class="titulo-secao">Feedback dos nossos clientes</h2>
						<h4 class="subtitulo-secao">
							Veja o que os nossos clientes acharam! 
							Confira os nossos produtos <a href="listagem-geral-produtos.php">aqui</a> e seja o próximo a avaliar!
						</h4>
					</div>
					<div class="container-avaliacoes">
						<div class="card-avaliacao">
							<i class="fa-solid fa-quote-left"></i>
							<h4>Ana Vitória</h4>
							<p>O site é intuitivo, o processo de compra foi tranquilo e as bolsas que encomendei vieram perfeitas. Estou mais do que satisfeita!</p>
						</div>
						<div class="card-avaliacao">
							<i class="fa-solid fa-quote-left"></i>
							<h4>Sarah Silva</h4>
							<p>Adorei a qualidade e o estilo das bolsas e acessórios que comprei neste ateliê. O atendimento foi excelente e recebi meu pedido rapidamente. Recomendo muito!</p>
						</div>
						<div class="card-avaliacao">
							<i class="fa-solid fa-quote-left"></i>
							<h4>Raiany Lima</h4>
							<p>As bolsas são maravilhosas, por serem feitas à mão é perceptível o cuidado e carinho que a artesã teve ao confeccioná-las.</p>
						</div>
					</div>
				</section>
			</main>
			<?php include '/componentes/footer.php'; ?>
		</body>
	</html>