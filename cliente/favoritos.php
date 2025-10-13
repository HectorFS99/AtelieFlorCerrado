<!DOCTYPE html>
<html lang="pt-br">
    <?php include '/componentes/head.php'; ?>
    <body>
        <?php
            include '/componentes/header.php'; 
                
            // Verifique se o usuário está logado
            if (!isset($_SESSION['id_usuario'])) {
                header('Location: login.php');
                exit;
            }
        
            $id_usuario = $_SESSION['id_usuario'];
        
            $result = mysql_query( 
                "SELECT 
                    f.id_produto
                    , p.nome
                    , p.caminho_imagem
                    , p.preco_atual
                    , p.preco_anterior
                    , f.dt_inclusao
                FROM 
                    favoritos AS f
                    INNER JOIN produtos AS p ON f.id_produto = p.id_produto
                WHERE 
                    f.id_usuario = $id_usuario"
            );    
        
            // Array para armazenar os itens favoritos
            $itens_favoritos = [];
            if (mysql_num_rows($result) > 0) {
                while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                    $itens_favoritos[] = $row;
                }
            }
        ?>
        <main style="margin-bottom: 3rem;">
            <?php if (count($itens_favoritos) > 0) { ?>
                <div class="cabecalho-favoritos">
                    <h3><i class="fa-solid fa-heart"></i> Seus Favoritos</h3>
                    <div class="btn-group">
                        <button class="btn btn-light" onclick="visualizarGrid();"><i class="fa-solid fa-grip"></i></button>
                        <button class="btn btn-light" onclick="visualizarLista();"><i class="fa-solid fa-list"></i></button>
                    </div>
                </div>

                <div id="visualizacaoCards" style="display: none;">
                    <?php foreach ($itens_favoritos as $item): ?>
                        <div class="card-favorito">
                            <a class="card-link_detalhes" href="detalhes-produto.php"><img class="img-favorito" src="<?= $item['caminho_imagem']; ?>"></a>
                            <p class="my-1">
                                <s class="text-muted">De: R$ <?= $item['preco_anterior']; ?></s><br>
                                <b>Por: <span style="font-size: 1.5rem;" class="text-success">R$ <?= $item['preco_atual']; ?></span></b>
                            </p>
                            <div class="d-flex gap-2">
                                <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?= $item['id_produto']; ?>&favoritos=true" class="btn btn-cor-principal w-100">
                                    <i class="fa-solid fa-cart-plus"></i>
                                    <b> Adicionar ao Carrinho</b>
                                </a>
                                <a href="./acoes/favorito/desfavoritar.php?id_produto=<?= $item['id_produto']; ?>&id_usuario=<?= $_SESSION['id_usuario']; ?>"
                                    class="btn btn-danger border-0">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div id="visualizacaoLista">
                    <?php foreach ($itens_favoritos as $item): ?>
                        <div class="item-favorito">
                            <div class="item-favorito_conteudo">
                                <a href="detalhes-produto.php"><img class="img-favorito" src="<?= $item['caminho_imagem']; ?>" /></a>
                                <div class="m-3">
                                    <p class="card-produto_titulo"><?= $item['nome']; ?></p>
                                    <div class="avaliacao-estrelas mb-3">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <b>(4.9)</b>
                                    </div>
                                    <p>
                                        <s class="text-muted">De: R$ <?= number_format($item['preco_anterior'], 2, ',', '.'); ?></s><br>
                                        <b>Por: <span style="font-size: 1.5rem;">R$ <?= number_format($item['preco_atual'], 2, ',', '.'); ?></span></b>
                                    </p>
                                    <p class="text-success">
                                        <b>à vista com pix, ou em 1x no Cartão de Crédito</b>
                                    </p>
                                    <p> ou em até 10x de <?= number_format($item['preco_atual'] / 10, 2, ',', '.'); ?> s/ juros </p>
                                </div>
                            </div>
                            <div class="item-favorito_opcoes">
                                <small class="text-center">Produto adicionado em <?= date('d/m/Y', strtotime($item['dt_inclusao'])); ?></small>
                                <div>
                                    <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?= $item['id_produto']; ?>&favoritos=true" class="btn btn-cor-principal">
                                        <i class="fa-solid fa-cart-plus"></i>
                                        <b> Adicionar ao Carrinho</b>
                                    </a>
                                    <a href="./acoes/favorito/desfavoritar.php?id_produto=<?= $item['id_produto']; ?>&id_usuario=<?= $_SESSION['id_usuario']; ?>"
                                        class="btn btn-danger border-0">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php } else { ?>
                <div class="aviso-ausencia-produtos" style="margin-bottom: 6rem;">
                    <i class="fa-solid fa-heart-crack" style="font-size: 4rem;"></i>
                    <h3>Poxa, você ainda não favoritou nada!</h3>
                    <h5>Que tal dar uma olhadinha em alguns de nossos produtos?</h5>
                    <a href="listagem-geral-produtos.php" class="btn btn-gradiente mt-2">Ver produtos</a>
                </div>
            <?php } ?>
        </main>
        <footer id="footer"></footer>
    </body>
</html>