<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../componentes/head.php'; ?>
    <body>
        <?php 
            include '../componentes/header.php';
            include '../acoes/conectar-bd.php';

            // Valores padrão (novo cadastro)
            $produto = [
                'id_produto'     => 0,
                'nome'           => '',
                'descricao'      => '',
                'preco_atual'    => '',
                'altura'         => '',
                'largura'        => '',
                'profundidade'   => '',
                'peso'           => '',
                'destaque'       => 0,
                'id_categoria'   => '',
                'caminho_imagem' => '',
                'ativo'          => 1
            ];

            // Se for edição (existe id_produto)
            if (isset($_GET['id_produto'])) {
                $ID = intval($_GET['id_produto']);

                $sql = $con -> prepare("
                    SELECT 
                        id_produto
                        , nome
                        , descricao
                        , preco_atual
                        , altura
                        , largura
                        , profundidade
                        , peso
                        , destaque
                        , id_categoria
                        , caminho_imagem
                        , ativo
                    FROM 
                        produtos
                    WHERE 
                        id_produto = ?
                ");

                $sql -> bind_param("i", $ID);
                $sql -> execute();
                $resultado = $sql -> get_result();
                $dados = $resultado -> fetch_assoc();

                if ($dados) {
                    $produto = $dados;
                } else {
                    echo
                        "<script>
                            alert('Produto não encontrado.');
                            window.location.href = 'produtos.php';
                        </script>";
                    exit();
                }
            }
        ?>
        <hr class="divisor">

        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="produtos.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    <?php echo $produto['id_produto'] ? 'Editar Produto' : 'Cadastrar Produto'; ?>
                </h3>
            </div>

            <form method="POST" name="form_produto" class="formulario w-100"
                action="../acoes/produto/salvar-produto.php<?php echo $produto['id_produto'] ? '?id_produto=' . $produto['id_produto'] : ''; ?>">

                <!-- Nome e Preço -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="txt_nome" type="text" required class="form-control"
                            placeholder="Nome do produto"
                            value="<?php echo $produto['nome']; ?>">
                        <label for="txt_nome">Nome:</label>
                    </div>
                    <div class="form-floating">
                        <input name="txt_precoAtual" type="text" required class="form-control"
                            placeholder="Preço atual"
                            value="<?php echo $produto['preco_atual']; ?>">
                        <label for="txt_precoAtual">Preço atual:</label>
                    </div>
                </div>

                <!-- Altura, Largura, Profundidade, Peso -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="txt_altura" type="text" class="form-control"
                            placeholder="Altura (cm)" value="<?php echo $produto['altura']; ?>">
                        <label for="txt_altura">Altura (cm):</label>
                    </div>
                    <div class="form-floating">
                        <input name="txt_largura" type="text" class="form-control"
                            placeholder="Largura (cm)" value="<?php echo $produto['largura']; ?>">
                        <label for="txt_largura">Largura (cm):</label>
                    </div>
                    <div class="form-floating">
                        <input name="txt_profundidade" type="text" class="form-control"
                            placeholder="Profundidade (cm)" value="<?php echo $produto['profundidade']; ?>">
                        <label for="txt_profundidade">Profundidade (cm):</label>
                    </div>
                    <div class="form-floating">
                        <input name="txt_peso" type="text" class="form-control"
                            placeholder="Peso (kg)" value="<?php echo $produto['peso']; ?>">
                        <label for="txt_peso">Peso (kg):</label>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="form-floating">
                    <textarea name="txt_descricao" required class="form-control"
                        placeholder="Descrição do produto"
                        style="height: 120px;"><?php echo $produto['descricao']; ?></textarea>
                    <label for="txt_descricao">Descrição:</label>
                </div>

                <!-- Categoria, Destaque, Ativo -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <select name="cbo_categoria" class="form-select" required>
                            <option value="">Selecione...</option>
                            <?php
                                $sql_cat = $con -> prepare("SELECT id_categoria, nome FROM categorias");
                                $sql_cat -> execute();
                                $res_cat = $sql_cat -> get_result();
                                while ($cat = $res_cat -> fetch_assoc()) {
                                    $selected = ($produto['id_categoria'] == $cat['id_categoria']) ? 'selected' : '';
                                    echo "<option value='{$cat['id_categoria']}' {$selected}>{$cat['nome']}</option>";
                                }
                            ?>
                        </select>
                        <label for="cbo_categoria">Categoria:</label>
                    </div>
                    <div class="form-floating">
                        <select name="cbo_destaque" class="form-select">
                            <option value="1" <?php echo $produto['destaque'] ? 'selected' : ''; ?>>Sim</option>
                            <option value="0" <?php echo !$produto['destaque'] ? 'selected' : ''; ?>>Não</option>
                        </select>
                        <label for="cbo_destaque">Colocar em destaque?</label>
                    </div>
                    <div class="form-floating">
                        <select name="cbo_ativo" class="form-select">
                            <option value="1" <?php echo $produto['ativo'] ? 'selected' : ''; ?>>Sim</option>
                            <option value="0" <?php echo !$produto['ativo'] ? 'selected' : ''; ?>>Não</option>
                        </select>
                        <label for="cbo_ativo">Produto ativo?</label>
                    </div>
                </div>

                <!-- Caminho da imagem -->
                <div class="form-floating">
                    <input name="txt_caminhoIM" type="text" required class="form-control"
                        placeholder="Caminho da imagem"
                        value="<?php echo $produto['caminho_imagem']; ?>">
                    <label for="txt_caminhoIM">Caminho da imagem:</label>
                </div>

                <!-- Botões -->
                <div class="form-botoes">
                    <button type="button" onclick="window.location.href='produtos.php'"
                        class="botao form-btn btn-cancelar">Cancelar</button>

                    <button type="submit"
                        class="botao form-btn btn-confirmar">
                        <?php echo $produto['id_produto'] ? 'Salvar Alterações' : 'Cadastrar Produto'; ?>
                    </button>
                </div>
            </form>
        </main>

    </body>
</html>