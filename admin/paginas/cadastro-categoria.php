<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../componentes/head.php'; ?>
    <body>
        <?php include '../componentes/header.php'; ?>
        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="./paginas/listagem/categorias.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Adicionar Categoria
                </h3>
            </div>
            <form method="POST" name="form_cad_categoria" class="formulario w-100">
                <!-- Nome, Descrição e Ícone -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="txt_nome" type="text" required class="form-control" placeholder="Nome completo">
                        <label for="txt_nome">Nome:</label>
                    </div>
                    <div class="form-floating">
                        <input name="txt_caminhoICONE" type="text" required class="form-control" placeholder="Nome completo">
                        <label for="txt_caminhoICONE">Ícone da Categoria:</label>
                    </div>
                </div>
                <div class="form-floating">
                    <textarea name="txt_descricao" required class="form-control" rows="6" placeholder="Nome completo"></textarea>
                    <label for="txt_descricao">Descrição:</label>
                </div>
                <div class="form-botoes">
                    <button onclick="window.location.href='categorias.php'" class="botao form-btn btn-cancelar">Cancelar</button>
                    <button onclick="document.form_cad_categoria.action='acoes_php/categoria/adicionar-categoria.php'" type="submit" value="Cadastrar" class="botao form-btn btn-confirmar">Confirmar</button>
                </div>
            </form>
        </main>
    </body>
</html>