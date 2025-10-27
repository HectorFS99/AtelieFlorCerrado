

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include '/componentes/head.php'; ?>
        <link rel="stylesheet" href="/cliente/recursos/css/carrinho-pagamento.css">
    </head>
    <body>
   	    <?php
            include '/componentes/header.php'; 

            // Verifica se o usuário está logado.
            if (!isset($_SESSION['id_usuario'])) {
                header('Location: login.php');
                exit;
            }

            $id_usuario = $_SESSION['id_usuario'];
            include '/acoes/carrinho/selecionar_produtos.php';
        ?>     
        <main class="custom-main mb-4">
            <?php if (count($itens_carrinho) > 0) { ?>
                <div class="coluna-1">
                    <?php foreach ($itens_carrinho as $item): ?>
                        <div class="info-container produto_container">
                            <div class="div-produto_info">
                                <a href="detalhes-produto.php?id_produto=<?= $item['id_produto']; ?>" class="div-produto_info_img">
                                    <img src="<?= $item['caminho_imagem']; ?>" alt="<?= $item['nome']; ?>" />
                                </a>
                                <div class="d-flex flex-column justify-content-between flex-fill">
                                    <h5><?= htmlspecialchars($item['nome']); ?></h5>
                                    
                                    <div class="avaliacao-estrelas">
                                        <!-- Exemplo de avaliação fixa (pode ajustar para ser dinâmica) -->
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <b>(4.9)</b>
                                    </div>

                                    <p>
                                        R$ <span name="lblValorProduto"><?= number_format($item['preco_atual'], 2, ',', '.'); ?></span> - 
                                        Em até 10x de <?= number_format($item['preco_atual'] / 10, 2, ',', '.'); ?> s/ juros
                                    </p>

                                    <div class="div-produto_opcoes">
                                        <div style="max-width: 200px;">
                                            <div class="input-group input-group-sm" style="background: rgba(128, 128, 128, 0.231); border-radius: var(--borda-arredondada);">
                                                <button
                                                    onclick="subtrairQtd('qtdProd<?= $item['id_produto']; ?>', 'lblValorProduto', 'lblQtdProduto', 'lblValorSubTotalPedido');"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <span class="input-group-text" id="qtdProd<?= $item['id_produto']; ?>" name="lblQtdProduto" class="mx-3">
                                                    <?= $item['total_quantidade']; ?>
                                                </span>
                                                <button
                                                    onclick="adicionarQtd('qtdProd<?= $item['id_produto']; ?>', 'lblValorProduto', 'lblQtdProduto', 'lblValorSubTotalPedido');"
                                                    class="btn btn-sm btn-success">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="./acoes/carrinho/remover_produto.php?id=<?= $item['id_produto']; ?>&usuario=<?= $_SESSION['id_usuario']; ?>"
                                                class="btn btn-sm btn-danger border-0">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="coluna-2">
                    <div class="info-container">
                        <div class="div-valor_info px-3 pt-3">
                            <?php
                                $total_itens = 0;
                                foreach ($itens_carrinho as $item) {
                                    $total_itens += $item['total_quantidade'];
                                }
                            ?>
                            <h5>Subtotal (<?= $total_itens; ?> itens):</h5>
                            <h4 class="text-success"><b>R$ <span id="lblValorSubTotalPedido"></span></b></h4>
                        </div>
                        <div class="p-3">
                            <a href="pagamento.php" class="btn btn-success w-100"><b>Comprar</b></a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="aviso-ausencia-produtos">
                    <i class="fa-solid fa-cart-plus" style="font-size: 4rem;"></i>
                    <h3>Poxa, não tem nada no seu carrinho!</h3>
                    <h5>Que tal dar uma olhadinha em alguns de nossos produtos?</h5>
                    <a href="listagem-geral-produtos.php" class="btn btn-gradiente mt-2">Ver produtos</a>
                </div>
            <?php } ?>   
        </main>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var subtotal = calcularSubtotal('lblValorProduto', 'lblQtdProduto', 'lblValorSubTotalPedido');
            });
        </script>        
    </body>
</html>