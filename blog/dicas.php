<?php 
	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<?php include '/componentes/head.php'; ?>

	<link rel="stylesheet" href="./recursos/css/geral.css">
	<link rel="stylesheet" href="./recursos/css/pagina-inicial.css">
	<link rel="stylesheet" href="./recursos/css/dicas.css">
	<link rel="stylesheet" href="./recursos/css/bastidores.css">
</head>

<body>
	<?php include '/componentes/header.php'; ?>

	<main>
		<section id="section-bastidores" class="secao-pagina">

			<h2 class="titulo-secao">Dicas de Artesanato</h2>
			<p class="subtitulo-pagina">
				Bolsas artesanais com estilo e personalidade.  
				Descubra técnicas, materiais e ideias para criar peças únicas.
			</p>

			<div class="bloco-conteudo-imagem">
				<img src="./recursos/imagens/dicas.jpg" 
					 alt="Artesã tecendo crochê com fio natural"
					 class="img-bastidores-grande">
			</div>

			<div class="conteudo-artesanato">
				
				<h3>1. Escolha dos materiais</h3>
				<p>Uma bolsa artesanal de qualidade começa com bons materiais. Tecidos como lona, algodão cru, sarja ou jeans reciclado são excelentes opções.</p>
				<p>Use forros estampados para dar personalidade e combine materiais naturais como palha, juta e couro ecológico.</p>
				<p><strong>Dica:</strong> retalhos e roupas antigas geram ótimos resultados e são sustentáveis.</p>

				<h3>2. Modelagem e corte</h3>
				<p>Faça o molde em papel kraft ou cartolina antes de cortar o tecido. Ajuste tamanho, bolsos e alças antes do corte definitivo.</p>
				<p>Utilize alfinetes ou fita para fixar as partes e garantir precisão.</p>
				<p><strong>Extra:</strong> deixe 1cm de margem de costura ao redor do molde.</p>

				<h3>3. Acabamentos</h3>
				<p>Os detalhes valorizam a peça. Prefira costuras reforçadas nas alças, use viés colorido e aposte em zíperes, botões e rendas para personalizar.</p>

				<h3>4. Sugestões de estilo</h3>
				<ul>
					<li><strong>Bolsas de praia:</strong> tecidos leves e alças de corda.</li>
					<li><strong>Ecobags:</strong> práticas para o dia a dia.</li>
					<li><strong>Mini bolsas:</strong> modernas e compactas.</li>
					<li><strong>Bolsas bordadas:</strong> excelente para presentes.</li>
				</ul>
				<p>Personalizações como nome da cliente ou chaveiros artesanais agregam valor.</p>

				<h3>5. Sustentabilidade</h3>
				<p>Prefira materiais reaproveitados e produtos não tóxicos. Artesanato também é respeito à natureza e à cultura.</p>

				<h3>6. Divulgue seu trabalho</h3>
				<p>Compartilhe fotos nas redes sociais, participe de feiras e crie uma galeria virtual com boas imagens e descrições.</p>

				<h3>Inspiração final</h3>
				<p>Criar bolsas artesanais é unir técnica e criatividade. Experimente, teste novas ideias e permita que seu estilo se destaque nas suas peças.</p>
			</div>

			<div class="container-videos">
				
				<div class="card-video">
					<img src="https://img.youtube.com/vi/F3SqCo2f6-A/hqdefault.jpg" 
						 alt="Bolsa saco em crochê">
					<h4>Bolsa Saco em Crochê</h4>
					<a href="https://www.youtube.com/watch?v=F3SqCo2f6-A" 
					   target="_blank" 
					   class="btn-youtube">Assistir</a>
				</div>

				<div class="card-video">
					<img src="https://img.youtube.com/vi/a_4nTKtNq3o/maxresdefault.jpg" 
						 alt="Cesto de fio náutico">
					<h4>Bolsa Chloe</h4>
					<a href="https://www.youtube.com/shorts/a_4nTKtNq3o" 
					   target="_blank" 
					   class="btn-youtube">Buscar vídeo</a>
				</div>

				<div class="card-video">
					<img src="https://img.youtube.com/vi/oCmeeXAja08/maxresdefault.jpg" 
						 alt="Chaveiro de crochê coração">
					<h4>Chaveiro de Crochê</h4>
					<a href="https://www.youtube.com/watch?v=oCmeeXAja08" 
					   target="_blank" 
					   class="btn-youtube">Assistir</a>
				</div>

				<div class="card-video">
					<img src="https://img.youtube.com/vi/F33wxUdyrgA/maxresdefault.jpg" 
						 alt="Gorro em crochê para iniciantes">
					<h4>Bolsa de Crochê para Iniciantes</h4>
					<a href="https://www.youtube.com/watch?v=F33wxUdyrgA&pp=ygUPYm9sc2EgZGUgY3JvY2hl0gcJCQMKAYcqIYzv" 
					   target="_blank" 
					   class="btn-youtube">Assistir</a>
				</div>

			</div>

		</section>
	</main>

	<?php include '/componentes/footer.php'; ?>
</body>
</html>
