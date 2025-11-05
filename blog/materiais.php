<?php
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<?php include '/componentes/head.php'; ?>

	<link rel="stylesheet" href="./recursos/css/geral.css">
	<link rel="stylesheet" href="./recursos/css/pagina-inicial.css">
	<link rel="stylesheet" href="./recursos/css/materiais.css">
	<link rel="stylesheet" href="./recursos/css/bastidores.css">
</head>

<body>
	<?php include '/componentes/header.php'; ?>

	<main>

		<!-- Materiais Sustentáveis -->
		<section id="section-materiais-sustentaveis" class="secao-pagina">
			
			<h2 class="titulo-secao">Materiais Sustentáveis</h2>
			<p class="subtitulo-pagina">A beleza que respeita a natureza</p>

			<div class="bloco-conteudo-imagem">
				<img src="./recursos/imagens/croche.webp" 
					 alt="Fios de algodão e juta utilizados no artesanato"
					 class="img-bastidores-grande">
			</div>

			<p class="paragrafo-secao-intro">
				No Ateliê Flor do Cerrado, acreditamos que a verdadeira beleza não precisa prejudicar o planeta. Cada material é escolhido com cuidado para unir qualidade, responsabilidade ambiental e valorização do artesanato brasileiro. Conheça as fibras que fazem parte da nossa produção e o porquê de cada escolha.
			</p>

			<h3 class="subtitulo-secao">Fibras naturais: o coração da nossa produção</h3>
			<p class="paragrafo-secao">
				Optamos por fibras renováveis e biodegradáveis, garantindo menor impacto ambiental e peças duráveis, com textura, identidade e alma artesanal.
			</p>

			<!-- Juta -->
			<h3 class="titulo-fibra">1. Juta</h3>
			<div class="detalhe-fibra-container">
				
				<div class="detalhe-fibra-texto">
					<p>
						A juta é uma das fibras mais sustentáveis do mundo. Biodegradável e de cultivo natural, ela possui textura marcante e resistência, sendo perfeita para peças atemporais e com personalidade.
					</p>

					<ul class="lista-detalhe-fibra">
						<li><strong>100% biodegradável:</strong> retorna ao solo sem resíduos tóxicos.</li>
						<li><strong>Aliada do meio ambiente:</strong> plantações absorvem grandes quantidades de CO₂.</li>
						<li><strong>Durabilidade e textura:</strong> traz rusticidade e firmeza às criações.</li>
					</ul>
				</div>

				<div class="detalhe-fibra-imagem">
					<img src="./recursos/imagens/juta.jpg" alt="Detalhe de fios de juta natural">
				</div>

			</div>

			<!-- Algodão -->
			<h3 class="titulo-fibra">2. Algodão</h3>
			<div class="detalhe-fibra-container reverse">

				<div class="detalhe-fibra-texto">
					<p>
						Usamos algodão em tramas e forros, garantindo maciez e conforto, aliado a uma produção mais consciente e responsável.
					</p>

					<ul class="lista-detalhe-fibra">
						<li><strong>Orgânico e reciclado:</strong> priorizamos fibras sem agrotóxicos e de reaproveitamento.</li>
						<li><strong>Sem tingimento:</strong> cores naturais reduzem consumo de água e químicos.</li>
						<li><strong>Responsabilidade social:</strong> fornecedores com boas práticas e certificações.</li>
					</ul>
				</div>

				<div class="detalhe-fibra-imagem">
					<img src="./recursos/imagens/algodao.webp" alt="Close em fios de algodão natural">
				</div>

			</div>
		</section>


		<!-- Cadeia Produtiva -->
		<section id="section-cadeia-produtiva" class="secao-pagina secao-bege">

			<h2 class="titulo-destaque">Nossa Cadeia Produtiva</h2>
			<p class="paragrafo-secao-intro">
				A sustentabilidade se reflete em todo o processo, do cultivo das fibras ao produto final.
			</p>
			
			<ul class="lista-detalhes-verticais">
				<li><strong>Comércio justo:</strong> priorizamos parceiros que valorizam o trabalho humano, a economia local e condições éticas.</li>
				<li><strong>Embalagens ecológicas:</strong> utilizamos materiais reciclados e biodegradáveis, reduzindo ao máximo o plástico.</li>
				<li><strong>Produção slow fashion:</strong> peças feitas com calma, qualidade e durabilidade, pensadas para acompanhar seu tempo, e não a pressa da moda descartável.</li>
			</ul>

			<h3 class="titulo-alma">O seu papel nesse ciclo</h3>
			<p class="paragrafo-secao">
				Ao escolher o Ateliê Flor do Cerrado, você apoia um modelo de produção consciente e valoriza o trabalho artesanal.
			</p>

			<ul class="lista-alma">
				<li><strong>Valoriza</strong> o tempo e a arte manual.</li>
				<li><strong>Reduz</strong> impactos no meio ambiente.</li>
				<li><strong>Investe</strong> em uma peça com história e propósito.</li>
			</ul>

		</section>

	</main>

	<?php include '/componentes/footer.php'; ?>
</body>
</html>
