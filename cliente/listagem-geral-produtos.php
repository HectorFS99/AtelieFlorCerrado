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
    <?php include '/componentes/head.php'; ?>
    <body>
        <?php include '/componentes/header.php'; ?>
        <main class="main-listagem">
            <!-- Menu de Filtros -->
            <div class="menu-filtros">
                <div class="titulo-secao d-flex justify-content-between align-items-center">
                    <h4>Filtros</h4>
                    <?php if ($filtro_aplicado) { ?>
                        <form method="GET" action="listagem-geral-produtos.php">
                            <button class="btn btn-light border" type="submit" name="filtrar_categoria" value="">
                                <i class="fa-solid fa-filter-circle-xmark"></i> Limpar
                            </button>
                        </form>		
					<?php } ?>                        
                </div>

                <!-- Categorias -->
                <button onclick="exibirFiltroAcc('acc-categorias');" class="btn btn-filtros_accordion">Categorias</button>
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

                <!-- Preço -->
                <button onclick="exibirFiltroAcc('acc-preco');" class="btn btn-filtros_accordion">Preço</button>
                <section id="acc-preco" class="acc">
                    <form method="GET" action="listagem-geral-produtos.php">
                        <div>
                            <label>Mínimo:</label>
                            <input type="number" name="preco_minimo" class="form-control" min="100" value="100" required>
                        </div>
                        <div class="my-2">
                            <label>Máximo:</label>
                            <input type="number" name="preco_maximo" class="form-control" min="100" max="20000" required>
                        </div>
                        <button type="submit" class="btn btn-cor-principal w-100">Aplicar</button>
                    </form>
                </section>
                
                <!-- Avaliações -->
                <button onclick="exibirFiltroAcc('acc-avaliacao');" class="btn btn-filtros_accordion border-0">Avaliação</button>
                <section id="acc-avaliacao" class="acc border-0 border-top">
                    <div class="text-muted mb-2">
                        <small>Desculpe, estamos desenvolvendo este filtro.</small>
                    </div>
                    <?php for($i = 1; $i <= 5; $i++) { ?>
                        <div class="form-check">
                            <input disabled class="form-check-input" type="checkbox" id="filtro-<?php echo $i; ?>estrelas">
                            <label class="form-check-label" for="filtro-<?php echo $i; ?>estrelas"><?php echo $i; ?> estrelas</label>
                        </div>
                    <?php } ?>
                </section>
            </div>

            <!-- Listagem de Produtos -->
            <div class="listagem-produtos">
                <div class="titulo-secao d-flex justify-content-between align-items-center">
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
                        <div href="detalhes-produto.php?id_produto=<?php echo $linha['id_produto']; ?>" class="card-produto_listagem">
                            <a href="detalhes-produto.php?id_produto=<?php echo $linha['id_produto']; ?>">
                                <img class="card-produto_listagem_img" src="<?php echo $linha['caminho_imagem']; ?>">
                            </a>
                            <h5 class="col-produto_listagem">
                                <?php echo $linha['nome']; ?>
                                <span>R$ <?php echo number_format($linha['preco_atual'], 2, ',', '.'); ?></span>
                            </h5>
                            <?php if (isset($_SESSION['autenticado']) && isset($_SESSION['id_usuario']) > 0) { ?>
                                <div class="col-produto_listagem opcoes-produto_listagem">
                                    <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?php echo $linha['id_produto']; ?>&comprarAgora=true" class="btn btn-cor-principal flex-fill">
                                        <strong>COMPRAR</strong>
                                    </a>
                                    <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?php echo $linha['id_produto']; ?>&listagem=true" class="btn btn-outline-success h-100">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </a>
                                    <a href="./acoes/favorito/favoritar.php?id_produto=<?php echo $linha['id_produto']; ?>" class="btn btn-outline-danger h-100">
                                        <i class="fa-regular fa-heart"></i>
                                    </a> 
                                </div>                               
                            <?php } else { ?>
                                <a href="login.php" class="btn btn-cor-principal mt-2">COMPRAR</a>                                
                            <?php } ?>
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