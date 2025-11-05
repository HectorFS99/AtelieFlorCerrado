<?php include '../componentes/head.php'; ?>
<body>
<?php 
    include '../componentes/header.php';

    $sql = $con -> prepare("
        SELECT 
            ped.id_pedido
            , ped.dt_pedido
            , ped.subtotal
            , ped.frete
            , ped.total
            , fpag.nome AS forma_pagamento
            , cpag.numero_cartao
            , pag.parcelas
            , CONCAT(end.logradouro, ', ', end.numero, ' - ', end.complemento, ', ', end.bairro, ' - ', end.cidade, ', ', end.uf) AS endereco
            , loj.endereco_completo AS endereco_loja
            , stt.nome AS status_pedido
            , ped.dt_entrega
            , usr.nome_completo
            , usr.email
            , usr.telefone_celular
        FROM 
            pedidos AS ped
            INNER JOIN pagamentos AS pag ON pag.id_pagamento = ped.id_pagamento
            INNER JOIN formas_pagamento AS fpag ON fpag.id_forma_pagamento = pag.id_forma_pagamento
            LEFT JOIN cartoes_pagamento AS cpag ON cpag.id_cartao_pagamento = pag.id_cartao_pagamento
            LEFT JOIN enderecos AS end ON end.id_endereco = ped.id_endereco
            LEFT JOIN lojas AS loj ON loj.id_loja = ped.id_loja
            INNER JOIN status AS stt ON stt.id_status = ped.id_status
            INNER JOIN usuarios AS usr ON usr.id_usuario = ped.id_usuario
        ORDER BY 
            ped.id_pedido DESC
    ");

    $sql -> execute();
    $resultado_pedidos = $sql -> get_result();
?>
<main class="conteudo-principal">
    <div class="titulo-opcoes">
        <h3 class="titulo">
            <a href="index.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
            Pedidos
        </h3>
    </div>
    <div class="table-responsive">
        <table id="tabela-pedidos" class="table table-striped">
            <thead>
                <tr class="tabela-linha">
                    <th>ID</th>
                    <th>Dt. Pedido</th>
                    <th>Subtotal</th>
                    <th>Frete</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Dt. Entrega</th>
                    <th>Cliente</th>
                    <th width="5%">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = $resultado_pedidos -> fetch_assoc()) { ?>
                    <tr class="tabela-linha">
                        <td><?php echo $linha['id_pedido']; ?></td>
                        <td><?php echo date('d/m/Y H:i:s', strtotime($linha['dt_pedido'])); ?></td>
                        <td>R$ <?php echo $linha['subtotal']; ?></td>
                        <td>R$ <?php echo $linha['frete']; ?></td>
                        <td>R$ <?php echo $linha['total']; ?></td>
                        <td><?php echo $linha['status_pedido']; ?></td>
                        <td><?php echo $linha['dt_entrega'] !== null ? date('d/m/Y H:i:s', strtotime($linha['dt_entrega'])) : "Não definida."; ?></td>
                        <td><?php echo $linha['nome_completo']; ?></td>
                        <td>
                            <div class="d-flex align-items-center justify-content-around">
                                <button class="btn-tabela btn-informacoes" 
                                    onclick="exibirInformacoesPedido('detalhesPedido_<?php echo $linha['id_pedido']; ?>', 'Detalhes do pedido <?php echo $linha['id_pedido']; ?>', '800px')">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                                
                                <button class="btn-tabela btn-produtos" 
                                    onclick="exibirInformacoesPedido('produtosPedido_<?php echo $linha['id_pedido']; ?>', 'Produtos do pedido <?php echo $linha['id_pedido']; ?>', '1300px')">
                                    <i class="fa-solid fa-cubes"></i>
                                </button>

                                <!-- Detalhes do pedido -->
                                <div id="detalhesPedido_<?php echo $linha['id_pedido']; ?>" style="display: none;">
                                    <div class="container-detalhes_ped">
                                        <div class="detalhes_ped-coluna">
                                            <?php if ($linha['endereco'] != null) { ?>
                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-truck-fast"></i> Enviar para</h4>
                                                    <p><?php echo $linha['endereco']; ?></p>            
                                                </div> 
                                            <?php } else { ?>
                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-box"></i> Retirar em</h4>
                                                    <p><?php echo $linha['endereco_loja']; ?></p>            
                                                </div>
                                            <?php } ?>

                                            <div class="mb-4">
                                                <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-at"></i> E-mail do Cliente</h4>
                                                <a href="mailto:<?php echo $linha['email']; ?>"><?php echo $linha['email']; ?></a>            
                                            </div>
                                            
                                            <div class="mb-4">
                                                <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-phone"></i> Telefone</h4>
                                                <p><?php echo $linha['telefone_celular']; ?></p>            
                                            </div>
                                        </div>

                                        <div class="detalhes_ped-coluna">
                                            <div class="mb-4">
                                                <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-file-invoice-dollar"></i> Pagamento</h4>
                                                <p><?php echo $linha['forma_pagamento']; ?></p>            
                                            </div>

                                            <?php if ($linha['numero_cartao'] != null) { ?>
                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-credit-card"></i> Cartão</h4>
                                                    <p>Final <?php echo $linha['numero_cartao']; ?></p>
                                                </div>

                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-layer-group"></i> Parcelas</h4>
                                                    <p><?php echo $linha['parcelas']; ?>x</p>
                                                </div>  
                                            <?php } ?>                                                           
                                        </div>                                               
                                    </div>
                                </div>

                                <!-- Produtos do pedido -->
                                <div id="produtosPedido_<?php echo $linha['id_pedido']; ?>" style="display: none;">
                                    <table id="tabela-produtos_<?php echo $linha['id_pedido']; ?>" class="table table-striped text-center align-middle">
                                        <thead>
                                            <tr class="tabela-linha">
                                                <th>ID</th>
                                                <th>Imagem</th>
                                                <th>Nome</th>
                                                <th>Preço atual</th>
                                                <th>Destaque?</th>
                                                <th>Categoria</th>
                                                <th width="5%">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql_produto = $con -> prepare("
                                                    SELECT 
                                                        PRD.id_produto
                                                        , PRD.caminho_imagem
                                                        , PRD.nome
                                                        , PRD.preco_atual
                                                        , PRD.destaque
                                                        , CAT.nome AS categoria
                                                    FROM 
                                                        pedidos_produtos AS PP
                                                        INNER JOIN produtos AS PRD ON PRD.id_produto = PP.id_produto
                                                        INNER JOIN categorias AS CAT ON CAT.id_categoria = PRD.id_categoria
                                                    WHERE 
                                                        PP.id_pedido = ?
                                                ");
                                                $sql_produto -> bind_param("i", $linha['id_pedido']);
                                                $sql_produto -> execute();
                                                $produtos_pedido = $sql_produto -> get_result();

                                                while ($produto = $produtos_pedido -> fetch_assoc()) { ?>
                                                    <tr class="tabela-linha">
                                                        <td><?php echo $produto['id_produto']; ?></td>
                                                        <td><img width="100px" src="../<?php echo $produto['caminho_imagem']; ?>" /></td>
                                                        <td><?php echo mb_strlen($produto['nome']) > 30 ? mb_substr($produto['nome'], 0, 30) . "..." : $produto['nome']; ?></td>
                                                        <td>R$ <?php echo $produto['preco_atual']; ?></td>
                                                        <td><?php echo $produto['destaque'] ? 'Sim' : 'Não'; ?></td>
                                                        <td><?php echo $produto['categoria']; ?></td>
                                                        <td>
                                                            <div class="d-flex align-items-center justify-content-center">
                                                                <a class="btn-tabela btn-editar" href="../detalhes-produto.php?id_produto=<?php echo $produto['id_produto']; ?>">
                                                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                            <?php } 
                                                $sql_produto -> close();
                                            ?>
                                        </tbody>
                                    </table>
                                    <script>
                                        transformarTabela('#tabela-produtos_<?php echo $linha['id_pedido']; ?>');
                                    </script>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>               
    </div>
</main>

<script>
    function exibirInformacoesPedido(idConteudo, titulo, larguraModal) {
        var htmlConteudo = document.getElementById(idConteudo);

        popupSwal.fire({ 
            title: `<span style="text-shadow: none !important;">${titulo}<span>` ,
            html: htmlConteudo.innerHTML,
            showConfirmButton: false,
            showCancelButton: true,
            cancelButtonText: "Fechar",
            width: larguraModal
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        transformarTabela('#tabela-pedidos');
    });
</script>
</body>
</html>