<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../componentes/head.php'; ?>
    <body>
        <?php
            include '../componentes/header.php';
            include '../acoes/conectar-bd.php';

            $categoria = [
                'id_categoria' => 0,
                'nome'         => '',
                'descricao'    => ''
            ];

            if (isset($_GET['id_categoria'])) {
                $id_categoria = intval($_GET['id_categoria']);

                $sql = $con -> prepare("
                    SELECT 
                        id_categoria
                        , nome
                        , descricao
                    FROM 
                        categorias
                    WHERE 
                        id_categoria = ?
                ");

                $sql -> bind_param("i", $id_categoria);
                $sql -> execute();
                $resultado = $sql -> get_result();
                $dados = $resultado -> fetch_assoc();

                if ($dados) {
                    $categoria = $dados;
                } else {
                    echo
                        "<script>
                            alert('Categoria não encontrada.');
                            window.location.href = 'categorias.php';
                        </script>";
                    exit();
                }
            }
        ?>
        <hr class="divisor">

        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="categorias.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    <?php echo $categoria['id_categoria'] ? 'Editar Categoria' : 'Cadastrar Categoria'; ?>
                </h3>
            </div>

            <form method="POST" name="form_categoria" class="formulario w-100"
                action="../acoes/categoria/salvar-categoria.php<?php echo $categoria['id_categoria'] ? '?id_categoria=' . $categoria['id_categoria'] : ''; ?>">

                <div class="formulario-grupo">
                    <div class="form-floating w-100">
                        <input name="nome" type="text" required class="form-control"
                            placeholder="Nome da categoria" value="<?php echo $categoria['nome']; ?>">
                        <label for="nome">Nome:</label>
                    </div>
                </div>

                <div class="form-floating">
                    <textarea name="descricao" required class="form-control" placeholder="Descrição"><?php echo $categoria['descricao']; ?></textarea>
                    <label for="descricao">Descrição:</label>
                </div>

                <div class="form-botoes">
                    <button type="button" onclick="window.location.href='categorias.php'"
                        class="botao form-btn btn-cancelar">Cancelar</button>

                    <button type="submit" class="botao form-btn btn-confirmar">
                        <?php echo $categoria['id_categoria'] ? 'Salvar Alterações' : 'Cadastrar'; ?>
                    </button>
                </div>
            </form>
        </main>
    </body>
</html>