<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include '/componentes/head.php'; ?>
        <link rel="stylesheet" href="/cliente/recursos/css/favoritos.css">
        <link rel="stylesheet" href="/cliente/recursos/css/listagem-geral-produtos.css">
    </head>
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
        <main class="main-centralizada">
            <?php if (count($itens_favoritos) > 0) { ?>
                <div class="cabecalho-favoritos">
                    <h3><i class="fa-solid fa-heart"></i> Seus Favoritos</h3>
                </div>

                <div class="grid-produtos">
                    <?php foreach ($itens_favoritos as $item): ?>
                        <div class="card-produto">
                            <a href="detalhes-produto.php?id_produto=<?php echo $item['id_produto']; ?>" class="card_produto_img" >
                                <img src="<?php echo $item['caminho_imagem']; ?>">
                            </a>
                            <div class="card-produto_detalhe">
                                <div class="detalhe-info">
                                    <h6><?php echo $item['nome']; ?></h6>
                                    <small>R$ <?php echo number_format($item['preco_atual'], 2, ',', '.'); ?></small>
                                </div>
                                <?php if (isset($_SESSION['autenticado']) && isset($_SESSION['id_usuario']) > 0) { ?>
                                    <div class="detalhe-opcoes">
                                        <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?php echo $item['id_produto']; ?>&comprarAgora=true" class="btn-card-produto">
                                            <i class="fa-solid fa-money-check-dollar"></i>
                                        </a>
                                        <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?php echo $item['id_produto']; ?>&favoritos=true" class="btn-card-produto">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </a>
                                    </div>                               
                                <?php } else { ?>
                                    <a href="login.php" class="btn-card-produto">
                                        <i class="fa-solid fa-money-check-dollar"></i>
                                    </a>                                
                                <?php } ?>                                
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