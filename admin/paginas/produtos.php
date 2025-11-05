<html lang="pt-br">
    <?php include '../componentes/head.php'; ?>        
    <body>
        <?php 
            include '../componentes/header.php';

            $sql = $con -> prepare("
                SELECT 
                    p.id_produto
                    , p.nome
                    , p.descricao
                    , p.preco_atual
                    , p.altura
                    , p.largura
                    , p.profundidade
                    , p.peso
                    , p.destaque
                    , c.nome as categoria
                    , p.caminho_imagem
                    , p.ativo
                FROM 
                    produtos p 
                    INNER JOIN categorias c on c.id_categoria = p.id_categoria
            ");

            $sql -> execute();
            $resultado = $sql -> get_result();
        ?>
        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="index.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Produtos
                </h3>
                <button onclick="window.location.href='form-produto.php'" class="botao btn-adicionar">
                    <i class="fa-solid fa-square-plus"></i> Adicionar
                </button>
            </div>
            <div class="table-responsive">
                <table id="tabela-produtos" class="table table-striped">
                    <!-- Cabeçalho da tabela -->
                    <thead>
                        <tr class="tabela-linha">
                            <th width="5%">ID</th>
                            <th>Nome</th>
                            <th width="10%">Preço</th>
                            <th width="5%">Destaque?</th>
                            <th>Categoria</th>
                            <th width="5%">Ativo?</th>
                            <th width="5%">Ações</th>
                        </tr>
                    </thead>
                    <!-- Corpo da tabela -->
                    <tbody>
                        <?php while ($linha = $resultado -> fetch_assoc()) { ?>
                            <tr class="tabela-linha">
                                <td><?php echo $linha['id_produto']; ?></td>
                                <td>
                                    <?php
                                        $nome = $linha['nome'];
                                        echo mb_strlen($nome) > 30 ? mb_substr($nome, 0, 30) . "..." : $nome;
                                    ?>
                                </td>
                                <td>R$ <?php echo $linha['preco_atual']; ?></td>
                                <td><?php echo $linha['destaque'] ? 'Sim' : 'Não'; ?></td>
                                <td><?php echo $linha['categoria']; ?></td>
                                <td><?php echo $linha['ativo'] ? 'Sim' : 'Não'; ?></td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <?php
                                            $icone = $linha['ativo'] ? 'fa-ban' : 'fa-check';
                                            $classe = $linha['ativo'] ? 'btn-tabela btn-excluir' : 'btn-tabela text-success';
                                            $titulo = $linha['ativo'] ? 'Desativar' : 'Ativar';
                                        ?>
                                        <a title="<?php echo $titulo; ?>" class="<?php echo $classe; ?>" href="../acoes/produto/toggle-produto.php?id_produto=<?php echo $linha['id_produto']; ?>">
                                            <i class="fa-solid <?php echo $icone; ?>"></i>
                                        </a>
                                        <a title="Editar produto" class="btn-tabela btn-editar" href="form-produto.php?id_produto=<?php echo $linha['id_produto']; ?>">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>               
            </div>
        </main>
    </body>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            transformarTabela('#tabela-produtos');
        });
    </script>
</html>