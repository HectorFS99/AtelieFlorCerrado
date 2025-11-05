<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../componentes/head.php'; ?>
    <body>
        <?php 
            include '../componentes/header.php';
            include '../acoes/conectar-bd.php';

            $sql = $con -> prepare("
                SELECT 
                    id_categoria
                    , nome
                    , descricao
                    , ativo
                FROM 
                    categorias
                ORDER BY 
                    id_categoria DESC
            ");

            $sql -> execute();
            $resultado = $sql -> get_result();
        ?>

        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="index.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Categorias
                </h3>
                <button onclick=\"window.location.href='form-categoria.php'\" class="botao btn-adicionar">
                    <i class="fa-solid fa-square-plus"></i> Adicionar
                </button>
            </div>

            <div class="table-responsive">
                <table id="tabela-categorias" class="table table-striped">
                    <thead>
                        <tr class="tabela-linha">
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th width="5%">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($linha = $resultado -> fetch_assoc()) { ?>
                            <tr class="tabela-linha">
                                <td><?php echo $linha['id_categoria']; ?></td>
                                <td><?php echo $linha['nome']; ?></td>
                                <td><?php echo $linha['descricao']; ?></td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <?php
                                            $icone = $linha['ativo'] ? 'fa-ban' : 'fa-check';
                                            $classe = $linha['ativo'] ? 'btn-tabela btn-excluir' : 'btn-tabela text-success';
                                            $titulo = $linha['ativo'] ? 'Desativar' : 'Ativar';
                                        ?>
                                        <a title="<?php echo $titulo; ?>" class="<?php echo $classe; ?>" href="../acoes/categoria/toggle-categoria.php?id_categoria=<?php echo $linha['id_categoria']; ?>">
                                            <i class="fa-solid <?php echo $icone; ?>"></i>
                                        </a>
                                        <a title="Editar produto" class="btn-tabela btn-editar" href="form-categoria.php?id_categoria=<?php echo $linha['id_categoria']; ?>">
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

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                transformarTabela('#tabela-categorias');
            });
        </script>
    </body>
</html>