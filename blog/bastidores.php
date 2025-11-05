<?php 
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<?php include '/componentes/head.php'; ?>

	<link rel="stylesheet" href="./recursos/css/geral.css">
	<link rel="stylesheet" href="./recursos/css/pagina-inicial.css">
	<link rel="stylesheet" href="./recursos/css/bastidores.css">
</head>

<body>
	<?php include '/componentes/header.php'; ?>

	<main>

		<!-- Seção Bastidores -->
		<section id="section-bastidores" class="secao-pagina">
			
			<h2 class="titulo-secao">Bastidores</h2>
			<p class="subtitulo-pagina">Um olhar sobre o processo artesanal por trás de cada criação</p>

			<div class="bloco-conteudo-imagem">
				<img src="./recursos/imagens/bastidores.webp" 
					 alt="Artesã tecendo crochê com fio natural"
					 class="img-bastidores-grande">
			</div>

			<h3 class="subtitulo-secao">A arte de fazer à mão</h3>
			<p class="paragrafo-secao">
				Cada peça é elaborada respeitando técnicas tradicionais, combinadas a um olhar contemporâneo e sustentável. 
				Tudo é feito com calma, intenção e zelo, valorizando a autenticidade do artesanal.
			</p>
			
			<ul class="lista-check">
				<li>
					<strong>O crochê e a trama:</strong> cada ponto é construído com atenção e paciência, formando a estrutura de cada bolsa.
				</li>
				<li>
					<strong>Inspiração no Cerrado:</strong> cores, texturas e resistência da flora local influenciam os acabamentos e o design.
				</li>
				<li>
					<strong>Acabamento manual:</strong> alças, forros e detalhes são finalizados à mão, garantindo qualidade e exclusividade.
				</li>
			</ul>

		</section>

		<!-- Seção Materiais -->
		<section id="section-materiais" class="secao-pagina secao-bege">
			
			<div class="layout-duas-colunas">

				<div class="texto-coluna">
					<h2 class="titulo-secao">Materiais Sustentáveis</h2>
					<p class="paragrafo-secao">
						A sustentabilidade faz parte da essência do Ateliê Flor do Cerrado. Selecionamos materiais com 
						responsabilidade, conciliando beleza, durabilidade e respeito ao meio ambiente.
					</p>
					
					<ul class="lista-materiais">
						<li>
							<strong>Algodão e juta:</strong> fibras naturais predominantes em nossa produção.
						</li>
						<li>
							Biodegradáveis e ecologicamente responsáveis.
						</li>
						<li>
							<strong>Parcerias éticas:</strong> fornecedores comprometidos com práticas justas e sustentáveis.
						</li>
					</ul>

					<a href="#" class="btn-saiba-mais">Saiba mais</a>
				</div>

				<div class="imagem-coluna">
					<img src="./recursos/imagens/linhas.jpg" 
						 alt="Fibras naturais de juta e algodão"
						 class="img-materiais">
				</div>

			</div>
		</section>

	</main>

	<?php include '/componentes/footer.php'; ?>
</body>
</html>
