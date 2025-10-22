<?php
	header('Content-Type: text/html; charset=utf-8');
	include '/acoes/conexao.php';

	// Consulta para categorias
	$sql_categorias = mysql_query(
		"SELECT
			`id_categoria`,
			`nome`,
			`descricao`,
			`caminho_icone`
		FROM
			`categorias`"
	);

    $ordenacao = isset($_GET['filtrar']) ? $_GET['filtrar'] : '';

    $filtro_categoria = isset($_GET['filtrar_categoria']) ? $_GET['filtrar_categoria'] : '';
    $preco_minimo = isset($_GET['preco_minimo']) ? floatval($_GET['preco_minimo']) : null;
    $preco_maximo = isset($_GET['preco_maximo']) ? floatval($_GET['preco_maximo']) : null;

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

    $condicoes = [];
    $filtro_aplicado = false;

    // Verifica categoria
    if ($filtro_categoria) {
        $condicoes[] = "id_categoria = " . intval($filtro_categoria);        
    }

    // Verifica preços
    if ($preco_minimo !== null) {
        $condicoes[] = "preco_atual >= " . $preco_minimo;
    }
    if ($preco_maximo !== null) {
        $condicoes[] = "preco_atual <= " . $preco_maximo;
    }

    // Adiciona condições à consulta
    if (count($condicoes) > 0) {
        $select_produtos .= " WHERE " . implode(" AND ", $condicoes);
        $filtro_aplicado = true;
    }

    // Modifica a consulta com base no filtro selecionado
    switch ($ordenacao) {
        case 'lancamento':
            $select_produtos .= " ORDER BY `dt_cadastro` DESC";
            $filtro_selecionado = " - Ordenado por lançamento";
            break;
        case 'menor_preco':
            $select_produtos .= " ORDER BY `preco_atual` ASC";
            $filtro_selecionado = " - Ordenado pelo menor preço";
            break;
        case 'maior_preco':
            $select_produtos .= " ORDER BY `preco_atual` DESC";
            $filtro_selecionado = " - Ordenado pelo maior preço";
            break;
        default:
            $select_produtos .= "";
            $filtro_selecionado = "";
            break;
    }

    $sql_produtos = mysql_query($select_produtos);
?>
<html lang="pt-br">
    <head>
        <?php include '/componentes/head.php'; ?>
        <link rel="stylesheet" href="/cliente/recursos/css/listagem-geral-produtos.css">
    </head>
    <body>
        <?php include '/componentes/header.php'; ?>
        <main class="main-listagem">
            <!-- Menu de Filtros -->
            <div class="menu-filtros">
                <div class="titulo-secao-produtos">
                    <h5>Filtrar por</h5>
                    <?php if ($filtro_aplicado) { ?>
                        <form method="GET" action="listagem-geral-produtos.php">
                            <button class="btn-limpar-filtro" type="submit" name="filtrar_categoria" value="">
                                <i class="fa-solid fa-filter-circle-xmark"></i>
                            </button>
                        </form>		
					<?php } ?>                        
                </div>

                <!-- Categorias -->
                <button onclick="exibirFiltroAcc('acc-categorias');" class="btn btn-filtros_accordion">Categoria</button>
                <section id="acc-categorias" class="acc">
                    <form method="GET" action="listagem-geral-produtos.php">
                        <ul class="filtro-lista_categorias">
                            <li><button type="submit" name="filtrar_categoria" value="" class="btn btn-categoria_filtro">Todos</button></li>
                            <?php while ($linha = mysql_fetch_assoc($sql_categorias)) { ?>
                                <li>
                                    <button type="submit" name="filtrar_categoria" value="<?php echo $linha['id_categoria']; ?>" class="btn btn-categoria_filtro">
                                        <?php echo $linha['nome']; ?>
                                    </button>
                                </li>
                            <?php } ?>
                        </ul>
                    </form>
                </section>
            </div>

            <!-- Listagem de Produtos -->
            <div>
                <div class="titulo-secao-produtos">
                    <h4>Produtos<?php echo $filtro_selecionado; ?></h4>                    
                    <div class="d-flex justify-content-between">
                        <form method="GET" action="listagem-geral-produtos.php">
                            <select name="filtrar" class="form-select" onchange="this.form.submit()">
                                <option selected>Ordenar por</option>
                                <option value="lancamento">Lançamento</option>
                                <option value="menor_preco">Menor preço</option>
                                <option value="maior_preco">Maior preço</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="grid-produtos">
                    <?php while($linha = mysql_fetch_assoc($sql_produtos)) { ?>
                        <div href="detalhes-produto.php?id_produto=<?php echo $linha['id_produto']; ?>" class="card-produto">
                            <a href="detalhes-produto.php?id_produto=<?php echo $linha['id_produto']; ?>">
                                <img class="card_produto_img" src="<?php echo $linha['caminho_imagem']; ?>">
                            </a>
                            <div class="card-produto_detalhe">
                                <div class="detalhe-info">
                                    <h6><?php echo $linha['nome']; ?></h6>
                                    <small>R$ <?php echo number_format($linha['preco_atual'], 2, ',', '.'); ?></small>
                                </div>
                                <?php if (isset($_SESSION['autenticado']) && isset($_SESSION['id_usuario']) > 0) { ?>
                                    <div class="detalhe-opcoes">
                                        <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?php echo $linha['id_produto']; ?>&comprarAgora=true" class="btn-card-produto">
                                            <i class="fa-solid fa-money-check-dollar"></i>
                                        </a>
                                        <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?php echo $linha['id_produto']; ?>&listagem=true" class="btn-card-produto">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </a>
                                        <a href="./acoes/favorito/favoritar.php?id_produto=<?php echo $linha['id_produto']; ?>" class="btn-card-produto">
                                            <i class="fa-regular fa-heart"></i>
                                        </a> 
                                    </div>                               
                                <?php } else { ?>
                                    <a href="login.php" class="btn-card-produto">
                                        <i class="fa-solid fa-money-check-dollar"></i>
                                    </a>                                
                                <?php } ?>                                
                            </div>
                        </div>
					<?php } ?>
                </div>            
            </div>
        </main>
		<?php include '/componentes/footer.php'; ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                exibirFiltroAcc('acc-categorias');
            });

            function exibirFiltroAcc(id_componente) {
                var accordion = document.getElementById(id_componente);
                accordion.style.display === "block" ? accordion.style.display = "none" : accordion.style.display = "block";
                accordion.classList.toggle("acc-aberto");
            }
        </script>
    </body>
</html>