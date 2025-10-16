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
        <main style="margin: 1rem;">
            <?php if (count($itens_favoritos) > 0) { ?>
                <div class="cabecalho-favoritos">
                    <h3><i class="fa-solid fa-heart"></i> Seus Favoritos</h3>
                </div>

                <div class="grid-produtos_favoritos">
                    <?php foreach ($itens_favoritos as $item): ?>
                        <div href="detalhes-produto.php?id_produto=<?= $item['id_produto']; ?>" class="card-produto_listagem">
                            <a href="detalhes-produto.php?id_produto=<?= $item['id_produto']; ?>">
                                <img class="card-produto_listagem_img" src="<?= $item['caminho_imagem']; ?>">
                            </a>
                            <h5 class="col-produto_listagem">
                                <?= $item['nome']; ?>
                                <span>R$ <?= number_format($item['preco_atual'], 2, ',', '.'); ?></span>
                            </h5>
                            <div class="col-produto_listagem opcoes-produto_listagem">
                                <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?= $item['id_produto']; ?>&comprarAgora=true" class="btn btn-cor-principal flex-fill">
                                    <strong>COMPRAR</strong>
                                </a>
                                <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?= $item['id_produto']; ?>&listagem=true" class="btn btn-outline-success h-100">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </a>
                                <a href="./acoes/favorito/desfavoritar.php?id_produto=<?= $item['id_produto']; ?>&id_usuario=<?= $_SESSION['id_usuario']; ?>"
                                    class="btn btn-danger border-0">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
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
        <?php include '/componentes/footer.php'; ?>
    </body>
</html>