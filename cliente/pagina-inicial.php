<?php
	header('Content-Type: text/html; charset=utf-8');
	include '/acoes/conexao.php';

	// Consulta base para produtos
	$select_produtos = 
		"SELECT
			`id_produto`,
			`nome`,
			`descricao`,
			`preco_anterior`,
			`preco_atual`,
			`altura`,
			`largura`,
			`profundidade`,
			`peso`,
			`destaque`,
			`oferta_relampago`,
			`id_categoria`,
			`caminho_imagem`,
			`ativo`
		FROM 
			`produtos`";
	
	// Consultas específicas para novidades
	$sql_novidades = mysql_query($select_produtos . "ORDER BY `dt_cadastro` DESC LIMIT 3");
?>
<html lang="pt-br">
	<head>
		<?php include '/componentes/head.php'; ?>
		<title>Flor do Cerrado</title>
	</head>
	<body>
		<?php include '/componentes/header.php'; ?>
		<main>
			<section id="section-inicio">
				<div class="div_inicio">
					<div class="div_inicio_infos">
						<div>
							<h1 class="titulos">Flor do Cerrado</h1>
							<h4 class="subtitulos">Sua bolsa artesanal feita com carinho, com um toque do Brasil.</h4>
						</div>

						<a href="sobre.php" class="btn btn-lg btn-gradiente">
							NOS CONHEÇA!
						</a>
					</div>
					<img width="400px" src="./recursos/imagens/produtos/sophie.png" alt="Bolsa artesanal feita com palha">
				</div>
			</section>
			<section class="secao">
				<div class="secao-titulo-subtitulo">
					<h2 class="titulo-secao">Novidades</h2>
					<h4 class="subtitulo-secao">
						Descubra as criações mais recentes do nosso ateliê — peças exclusivas que unem tradição, elegância e sustentabilidade.
					</h4>
				</div>
				<div class="produtos_cards">
					<?php while($linha = mysql_fetch_assoc($sql_novidades)) { ?>
						<a href="detalhes-produto.php?id_produto=<?php echo $linha['id_produto']; ?>" class="card-produto">
							<img src="<?php echo $linha['caminho_imagem']; ?>" class="card-produto_img" alt="..." />
							<div class="card-produto_conteudo">
								<p class="card-produto_titulo"><?php echo $linha['nome']; ?></p>
								<p>
									<s class="text-muted">De: R$ <?php echo number_format($linha['preco_anterior'], 2, ',', '.'); ?></s><br>
									<b>Por: <span style="font-size: 1.5rem;">R$ <?php echo number_format($linha['preco_atual'], 2, ',', '.'); ?></span></b>
								</p>
								<p class="text-success">
									<b>à vista com pix, ou em 1x no Cartão de Crédito</b>
								</p>
								<p> ou em até 10x de R$ <?php echo number_format($linha['preco_atual'] / 10, 2, ',', '.'); ?> s/ juros </p>
							</div>                            
						</a>    
					<?php } ?>
				</div>
			</section>

			<section class="secao custom-main">
			</section>

			<section class="secao custom-main">
			</section>

			<section class="secao custom-main">
			</section>
		</main>
		<footer id="footer"></footer>
	</body>
</html>