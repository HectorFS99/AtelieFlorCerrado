<?php
    $ID = 0;
    $categoria = null;

    // Buscar categoria pela API
    if (isset($_GET['id_categoria'])) {
        $ID = $_GET['id_categoria'];

        $url = "http://localhost:8080/categorias/$ID";
        $json = @file_get_contents($url);

        if ($json !== false) {
            $categoria = json_decode($json, true);
        } else {
            echo "<script>alert('Categoria não encontrada!');window.location.href='adm_categorias.php';</script>";
            exit;
        }
    }

    // Atualizar categoria via API
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = array(
            "idCategoria" => $ID,
            "nome" => isset($_POST['nome']) ? $_POST['nome'] : '',
            "descricao" => isset($_POST['descricao']) ? $_POST['descricao'] : '',
            "caminhoIcone" => isset($_POST['caminho_icone']) ? $_POST['caminho_icone'] : ''
        );

        $url = "http://localhost:8080/categorias/atualizar/$ID";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($dados))
        ));

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 200) {
            echo "<script>alert('Categoria atualizada com sucesso!');window.location.href='adm_categorias.php';</script>";
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar categoria!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include '/componentes/adm_head.php'; ?>
    <link rel="stylesheet" href="/recursos/css/adm_geral.css" />
    <title>Editar Categoria</title>
</head>
<body>
    <?php include '/componentes/adm_header.php'; ?>
    <hr class="divisor">
    <main class="conteudo-principal">
        <div class="titulo-opcoes">
            <h3 class="titulo">
                <a href="adm_categorias.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                Editar Categoria
            </h3>
        </div>
        <form method="POST" name="form_ed_categoria" class="formulario w-100">
            <input type="hidden" name="id_categoria" value="<?= htmlspecialchars(isset($categoria['idCategoria']) ? $categoria['idCategoria'] : '') ?>">
            <div class="formulario-grupo">
                <div class="form-floating">
                    <input name="nome" type="text" required class="form-control" placeholder="Nome da categoria" value="<?= htmlspecialchars(isset($categoria['nome']) ? $categoria['nome'] : '') ?>">
                    <label for="nome">Nome:</label>
                </div>
                <div class="form-floating">
                    <input name="caminho_icone" type="text" required class="form-control" placeholder="Caminho do ícone" value="<?= htmlspecialchars(isset($categoria['caminhoIcone']) ? $categoria['caminhoIcone'] : '') ?>">
                    <label for="caminho_icone">Caminho do ícone:</label>
                </div>
            </div>
            <div class="form-floating">
                <textarea name="descricao" required class="form-control" rows="6" placeholder="Descrição"><?= htmlspecialchars(isset($categoria['descricao']) ? $categoria['descricao'] : '') ?></textarea>
                <label for="descricao">Descrição:</label>
            </div>
            <div class="form-botoes">
                <button type="button" onclick="window.location.href='adm_categorias.php'" class="botao form-btn btn-cancelar">Cancelar</button>
                <button type="submit" value="Confirmar" class="botao form-btn btn-confirmar">Confirmar</button>
            </div>
        </form>
    </main>
</body>
</html>