<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include '/componentes/head.php'; ?>
        <link rel="stylesheet" href="/cliente/recursos/css/detalhes-produto.css">
    </head>
    <body>
        <?php include '/componentes/header.php'; ?>
        <?php
            if (isset($_GET['id_produto'])) {
                $id_produto = $_GET['id_produto'];
                $select_produtos = "
                    SELECT
                        `id_produto`,
                        `nome`,
                        `descricao`,
                        `preco_anterior`,
                        `preco_atual`,
                        `altura`,
                        `largura`,
                        `profundidade`,
                        `peso`,
                        `id_categoria`,
                        `caminho_imagem`
                    FROM
                        `produtos`
                    WHERE
                        `id_produto` = '$id_produto'
                ";

                $resultado = mysql_query($select_produtos);

                if ($produto = mysql_fetch_assoc($resultado)) { } else {
                    echo "Produto não encontrado.";
                }
            } else {
                echo "ID do produto não fornecido.";
            }
        ?>
        <?php
            if (isset($_GET['id_produto'])) {
                $id_produto = $_GET['id_produto'];

                $select_avaliacoes = "
                    SELECT
                        `id_produto`,
                        `id_usuario`,
                        `avaliacao`,
                        `dt_avaliacao`,
                        `titulo`,
                        `descricao`,
                        `imagem`,
                        `verificado`

                    FROM
                        `avaliacoes`
                    WHERE
                        `id_produto` = '$id_produto'
                ";

                $resultado2 = mysql_query($select_avaliacoes);
                $avaliacao = mysql_fetch_assoc($resultado2);
            } else {
                if (isset($avaliacao['id_usuario'])) {
                    $id_usuario = $avaliacao['id_usuario'];

                    $select_nome = "
                        SELECT
                            `nome_completo`

                        FROM
                            `usuarios`
                        WHERE
                            `id_usuario` = '$id_usuario'
                    ";

                    $resultado3 = mysql_query($select_nome);

                    if ($nome = mysql_fetch_assoc($resultado3)) { } else {
                        echo "Usuario não encontrado.";
                    }
                }
            }
        ?>
        <main class="main-detalhes">
            <div class="detalhes">
                <div class="detalhes-midias">
                    <img src="<?php echo $produto['caminho_imagem']; ?>" class="produto_img" />
                </div>
                <div class="detalhes-conteudo">
                    <!-- Título e estrelas de avaliação -->
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="mb-2"><?php echo $produto['nome']; ?></h2>
                        <?php if ($avaliacao == true) { ?>
                            <div class="avaliacao-estrelas">
                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php } ?>
                                <b>(4.9)</b>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- Preço -->
                    <p>R$ <?php echo number_format($produto['preco_atual'], 2, ',', '.'); ?> - Em até 10x de R$ <?php echo number_format($produto['preco_atual'] / 10, 2, ',', '.'); ?></p>

                    <!-- Ações -->
                    <div class="detalhes-conteudo_botoes" id="grpBtnAcoes">
                        <div id="div-qtd" class="input-group">
                            <button onclick="subtrairQtd('qtdProd2', 'lblValorProduto', 'lblQtdProduto', 'lblValorSubTotalPedido');" class="btn btn-success">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input id="qtdProd2" name="lblQtdProduto" class="form-control" type="number" value="1"/>
                            <button onclick="adicionarQtd('qtdProd2','lblValorProduto', 'lblQtdProduto', 'lblValorSubTotalPedido');" class="btn btn-success">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <a href="pagamento.php" class="btn btn-success">
                            <strong>COMPRAR</strong>
                        </a>
                        <a href="./acoes/carrinho/adicionar_produto.php?id_produto=<?= $id_produto ?>" class="btn btn-cor-principal">
                            <strong><i class="fa-solid fa-cart-plus"></i> ADICIONAR AO CARRINHO</strong>
                        </a>
                    </div>

                    <div id="btnAviseMe" style="display: none;">
                        <button onclick="avisarQuandoChegar();" class="btn btn-lg btn-danger w-100"><strong><i class="fa-solid fa-bell"></i> Avise-me quando chegar</strong></button>
                    </div>

                    <!-- Frete -->
                    <div class="frete">
                        <h5 class="mb-1">Calcular frete e prazo</h5>
                        <div class="input-group">
                            <input id="txtCep" type="text" class="form-control" placeholder="Informe o CEP">
                            <button class="btn btn-success" onclick="pesquisaCep('txtCep');" type="button">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <a href="https://buscacepinter.correios.com.br/app/endereco/index.php" class="btn btn-outline-success" target="_blank">
                                Não sei o meu CEP
                            </a>
                        </div>
                        <div id="resultado-frete" style="display: none;">
                            <span id="resultado-cep_logradouro"></span> - <span id="resultado-cep_bairro"></span><br>
                            <small id="resultado-cep_cidade"></small> - <small id="resultado-cep_uf"></small>
                        </div>
                    </div>

                    <div class="detalhes-info">
                        <div>
                            <h5>Dimensões</h5>
                            <ul>
                                <li>Altura: <?php echo $produto['altura']; ?></li>
                                <li>Profundidade: <?php echo $produto['profundidade']; ?></li>
                                <li>Largura: <?php echo $produto['largura']; ?></li>
                                <li>Peso: <?php echo $produto['peso']; ?></li>
                            </ul>
                        </div>
                        <div>
                            <h5>Descrição</h5>
                            <p><?php echo $produto['descricao']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulário de avaliação do usuário (caso esteja logado) -->
            <?php if (isset($_SESSION['autenticado']) && isset($_SESSION['id_usuario']) > 0) { ?>
                <div class="avaliacao-usuario">
                    <div class="avaliacao-usuario_cabecalho">
                        <div class="avaliacao-usuario_info">
                            <img src="recursos/imagens/usuarios/user_sample.png">
                            <div>
                                <h6 class="m-0">Você</h6>
                                <b><small class="text-success"><i class="fa-solid fa-circle-check"></i> Avalie este produto.</small></b>
                            </div>
                        </div>
                    </div>

                    <div class="avaliacao-usuario_corpo">
                        <form action="salvar_avaliacao.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>"> <!-- ID do usuário autenticado -->
                            <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>"> <!-- Produto sendo avaliado -->

                            <div class="avaliacao-estrelas mb-2">
                                <label for="avaliacao" class="form-label"><b>Nota:</b></label>
                                <select name="avaliacao" id="avaliacao" required>
                                    <option value="5">5 estrelas</option>
                                    <option value="4">4 estrelas</option>
                                    <option value="3">3 estrelas</option>
                                    <option value="2">2 estrelas</option>
                                    <option value="1">1 estrela</option>
                                </select>
                            </div>

                            <label for="titulo"><b>Título:</b></label>
                            <input type="text" id="titulo" name="titulo" maxlength="50" required class="form-control mb-2" value="<?php echo isset($titulo) ? $titulo : ''; ?>">

                            <label for="descricao"><b>Descrição:</b></label>
                            <textarea id="descricao" name="descricao" maxlength="1000" required class="form-control mb-2"><?php echo isset($descricao) ? $descricao : ''; ?></textarea>

                            <label for="imagem"><b>Imagem (opcional):</b></label>
                            <input type="file" id="imagem" name="imagem" accept="image/*" class="form-control mb-2">

                            <button type="submit" class="btn btn-lg btn-success mt-3">Enviar Avaliação</button>
                        </form>
                    </div>
                </div>
            <?php } ?>

            <!-- Avaliações dos clientes -->
            <div class="detalhes-avaliacoes_titulo">
                <h3 class="mb-2">
                    <i class="fa-solid fa-star"></i> Avaliações
                </h3>
                <?php if ($avaliacao == true) { ?>
                    <div class="avaliacao-estrelas">
                        <?php for ($i = 0; $i < 5; $i++) { ?>
                            <i class="fa-solid fa-star"></i>
                        <?php } ?>
                        <b>(4.9)</b>
                    </div>
                <?php } ?>
            </div>

            <!--  VERIFICA SE HÁ AVALIAÇÕES -->
            <?php if ($avaliacao == true) { ?>
                <div class="avaliacao-usuario">
                    <div class="avaliacao-usuario_cabecalho">
                        <div class="avaliacao-usuario_info">
                            <img src="recursos/imagens/usuarios/user_sample.png">
                            <div>
                                <h6 class="m-0"><?php echo $nome["nome_completo"]; ?></h6>
                                <?php
                                    if ($avaliacao["verificado"] == 1) {
                                        echo '<b><small class="text-success"><i class="fa-solid fa-circle-check"></i> Verificado(a)</small></b>';
                                    } else {
                                        echo '<b><small class="text-danger"><i class="fa-solid fa-circle-xmark"></i> Não verificado</small></b>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="d-flex flex-column m-4">
                            <div class="avaliacao-estrelas">
                                <?php
                                    $nota = (int) $avaliacao["avaliacao"];
                                    
                                    for ($i = 0; $i < $nota; $i++) {
                                        echo '<i class="fa-solid fa-star"></i>';
                                    }

                                    for ($i = $nota; $i < 5; $i++) {
                                        echo '<i class="fa-regular fa-star"></i>';
                                    }
                                ?>
                            </div>
                            <small class="text-end">
                                <?php
                                    date_default_timezone_set('America/Sao_Paulo');
                                    echo date('d/m/Y', strtotime($avaliacao["dt_avaliacao"])); 
                                ?>
                            </small>
                        </div>
                    </div>
                    <div class="avaliacao-usuario_corpo">
                        <p><b><?php echo $avaliacao["titulo"]; ?></b></p>
                        <p><?php echo $avaliacao["descricao"]; ?></p>
                        <img src="<?php echo $produto["caminho_imagem"]; ?>" class="produto_img" />
                    </div>
                    <div class="avaliacao-usuario_rodape">
                        <small>
                            Essa avaliação foi útil? 
                            <i class="fa-regular fa-thumbs-up"></i>68
                            <i class="fa-regular fa-thumbs-down"></i>12
                        </small>
                    </div>
                </div>
            <?php } else { ?>
                <p>Nenhuma avaliação encontrada para este produto.</p>
            <?php } ?>
        </main>
        <?php include '/componentes/footer.php'; ?>
    </body>
</html>