<?php
    $ID = 0;
    $produto = null;

    if (isset($_GET['id_produto'])) {
        $ID = $_GET['id_produto'];

        // Buscar produto pela API
        $url = "http://localhost:8080/produtos/$ID";
        $json = @file_get_contents($url);

        if ($json !== false) {
            $produto = json_decode($json, true);
        } else {
            echo "<script>alert('Produto não encontrado!');window.location.href='adm_produtos.php';</script>";
            exit;
        }
    }

    // Atualizar produto via API
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = array(
            "idProduto" => $ID,
            "nome" => isset($_POST['txt_nome']) ? $_POST['txt_nome'] : '',
            "descricao" => isset($_POST['txt_descricao']) ? $_POST['txt_descricao'] : '',
            "precoAnterior" => isset($_POST['txt_precoAnt']) ? $_POST['txt_precoAnt'] : '',
            "precoAtual" => isset($_POST['txt_precoAtual']) ? $_POST['txt_precoAtual'] : '',
            "altura" => isset($_POST['txt_altura']) ? $_POST['txt_altura'] : '',
            "largura" => isset($_POST['txt_largura']) ? $_POST['txt_largura'] : '',
            "profundidade" => isset($_POST['txt_profundidade']) ? $_POST['txt_profundidade'] : '',
            "peso" => isset($_POST['txt_peso']) ? $_POST['txt_peso'] : '',
            "destaque" => isset($_POST['cbo_destaque']) ? ($_POST['cbo_destaque'] == "1" ? true : false) : false,
            "ofertaRelampago" => isset($_POST['cbo_oferta']) ? ($_POST['cbo_oferta'] == "1" ? true : false) : false,
            "categoria" => array(
                "idCategoria" => isset($_POST['cbo_categoria']) ? $_POST['cbo_categoria'] : ''
            ),
            "caminhoImagem" => isset($_POST['txt_caminhoIM']) ? $_POST['txt_caminhoIM'] : '',
            "ativo" => isset($_POST['cbo_ativo']) ? ($_POST['cbo_ativo'] == "1" ? true : false) : false
        );

        $url = "http://localhost:8080/produtos/atualizar/$ID";
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
            echo "<script>alert('Produto atualizado com sucesso!');window.location.href='adm_produtos.php';</script>";
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar produto!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include '/componentes/adm_head.php'; ?>
    <link rel="stylesheet" href="/recursos/css/adm_geral.css" />
    <title>Editar Produto</title>
</head>
<body>
    <?php include '/componentes/adm_header.php'; ?>
    <hr class="divisor">
    <main class="conteudo-principal">
        <div class="titulo-opcoes">
            <h3 class="titulo">
                <a href="adm_produtos.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                Editar Produto
            </h3>
        </div>
        <form method="POST" name="form_ed_produtos" class="formulario w-100">
            <div class="formulario-grupo">
                <div class="form-floating">
                    <input name="txt_nome" type="text" required class="form-control" placeholder="Nome completo" value="<?= htmlspecialchars(isset($produto['nome']) ? $produto['nome'] : '') ?>">
                    <label for="txt_nome">Nome:</label>
                </div>
                <div class="form-floating">
                    <input name="txt_precoAnt" type="text" required class="form-control" placeholder="Preço anterior" value="<?= htmlspecialchars(isset($produto['precoAnterior']) ? $produto['precoAnterior'] : '') ?>">
                    <label for="txt_precoAnt">Preço anterior:</label>
                </div>
                <div class="form-floating">
                    <input name="txt_precoAtual" type="text" required class="form-control" placeholder="Preço atual" value="<?= htmlspecialchars(isset($produto['precoAtual']) ? $produto['precoAtual'] : '') ?>">
                    <label for="txt_precoAtual">Preço atual:</label>
                </div>
            </div>
            <div class="formulario-grupo">
                <div class="form-floating">
                    <input name="txt_altura" type="text" required class="form-control" placeholder="Altura (cm)" value="<?= htmlspecialchars(isset($produto['altura']) ? $produto['altura'] : '') ?>">
                    <label for="txt_altura">Altura (cm):</label>
                </div>
                <div class="form-floating">
                    <input name="txt_largura" type="text" required class="form-control" placeholder="Largura (cm)" value="<?= htmlspecialchars(isset($produto['largura']) ? $produto['largura'] : '') ?>">
                    <label for="txt_largura">Largura (cm):</label>
                </div>
                <div class="form-floating">
                    <input name="txt_profundidade" type="text" required class="form-control" placeholder="Profundidade (cm)" value="<?= htmlspecialchars(isset($produto['profundidade']) ? $produto['profundidade'] : '') ?>">
                    <label for="txt_profundidade">Profundidade (cm):</label>
                </div>
                <div class="form-floating">
                    <input name="txt_peso" type="text" required class="form-control" placeholder="Peso (kg)" value="<?= htmlspecialchars(isset($produto['peso']) ? $produto['peso'] : '') ?>">
                    <label for="txt_peso">Peso (kg):</label>
                </div>
            </div>
            <div class="form-floating">
                <textarea name="txt_descricao" required class="form-control" rows="6" placeholder="Descrição"><?= htmlspecialchars(isset($produto['descricao']) ? $produto['descricao'] : '') ?></textarea>
                <label for="txt_descricao">Descrição:</label>
            </div>
            <div class="formulario-grupo">
                <div class="form-floating">
                    <select name="cbo_categoria" class="form-select">
                        <option></option>
                        <option value="1" <?= (isset($produto['categoria']['idCategoria']) && $produto['categoria']['idCategoria'] == 1) ? 'selected' : '' ?>>Escritório</option>
                        <option value="2" <?= (isset($produto['categoria']['idCategoria']) && $produto['categoria']['idCategoria'] == 2) ? 'selected' : '' ?>>Quarto</option>
                        <option value="3" <?= (isset($produto['categoria']['idCategoria']) && $produto['categoria']['idCategoria'] == 3) ? 'selected' : '' ?>>Cozinha</option>
                        <option value="4" <?= (isset($produto['categoria']['idCategoria']) && $produto['categoria']['idCategoria'] == 4) ? 'selected' : '' ?>>Sala de Jantar</option>
                        <option value="5" <?= (isset($produto['categoria']['idCategoria']) && $produto['categoria']['idCategoria'] == 5) ? 'selected' : '' ?>>Área Externa</option>
                        <option value="6" <?= (isset($produto['categoria']['idCategoria']) && $produto['categoria']['idCategoria'] == 6) ? 'selected' : '' ?>>Sala de Estar</option>
                    </select>
                    <label for="cbo_categoria">Selecione a categoria:</label>
                </div>
                <div class="form-floating">
                    <select name="cbo_destaque" class="form-select">
                        <option value="1" <?= (isset($produto['destaque']) && $produto['destaque']) ? 'selected' : '' ?>>Sim</option>
                        <option value="0" <?= (isset($produto['destaque']) && !$produto['destaque']) ? 'selected' : '' ?>>Não</option>
                    </select>
                    <label for="cbo_destaque">Colocar em destaque?</label>
                </div>
                <div class="form-floating">
                    <select name="cbo_oferta" class="form-select">
                        <option value="1" <?= (isset($produto['ofertaRelampago']) && $produto['ofertaRelampago']) ? 'selected' : '' ?>>Sim</option>
                        <option value="0" <?= (isset($produto['ofertaRelampago']) && !$produto['ofertaRelampago']) ? 'selected' : '' ?>>Não</option>
                    </select>
                    <label for="cbo_oferta">É oferta relâmpago?</label>
                </div>
                <div class="form-floating">
                    <select name="cbo_ativo" class="form-select">
                        <option value="1" <?= (isset($produto['ativo']) && $produto['ativo']) ? 'selected' : '' ?>>Sim</option>
                        <option value="0" <?= (isset($produto['ativo']) && !$produto['ativo']) ? 'selected' : '' ?>>Não</option>
                    </select>
                    <label for="cbo_ativo">O produto estará ativo?</label>
                </div>
            </div>
            <div class="form-floating">
                <input name="txt_caminhoIM" type="text" required class="form-control" placeholder="Caminho da imagem" value="<?= htmlspecialchars(isset($produto['caminhoImagem']) ? $produto['caminhoImagem'] : '') ?>">
                <label for="txt_caminhoIM">Caminho da imagem:</label>
            </div>
            <div class="form-botoes">
                <button type="button" onclick="window.location.href='adm_produtos.php'" class="botao form-btn btn-cancelar">Cancelar</button>
                <button type="submit" value="Confirmar" class="botao form-btn btn-confirmar">Confirmar</button>
            </div>
        </form>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatarData(data) {
                var opcoesData = { day: 'numeric', month: 'long', year: 'numeric' };
                var dataFormatada = data.toLocaleDateString('pt-BR', opcoesData);

                var horas = String(data.getHours()).padStart(2, '0');
                var minutos = String(data.getMinutes()).padStart(2, '0');

                return dataFormatada + ' - ' + horas + ':' + minutos;
            }

            var dataAtual = new Date();
            var elementoData = document.getElementById('data-atual');

            if (elementoData) {
                elementoData.textContent = formatarData(dataAtual);
            }
        });
    </script>
</body>
</html>