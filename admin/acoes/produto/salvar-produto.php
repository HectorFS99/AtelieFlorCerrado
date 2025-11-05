<?php
    include '../conectar-bd.php';

    $ID             = isset($_GET['id_produto']) ? intval($_GET['id_produto']) : 0;
    $nome           = $_POST['txt_nome'];
    $descricao      = $_POST['txt_descricao'];
    $preco_atual    = floatval($_POST['txt_precoAtual']);
    $altura         = $_POST['txt_altura']       !== '' ? floatval($_POST['txt_altura'])       : null;
    $largura        = $_POST['txt_largura']      !== '' ? floatval($_POST['txt_largura'])      : null;
    $profundidade   = $_POST['txt_profundidade'] !== '' ? floatval($_POST['txt_profundidade']) : null;
    $peso           = $_POST['txt_peso']         !== '' ? floatval($_POST['txt_peso'])         : null;
    $id_categoria   = intval($_POST['cbo_categoria']);
    $caminho_imagem = $_POST['txt_caminhoIM'];
    $destaque       = isset($_POST['cbo_destaque']) ? 1 : 0;
    $ativo          = isset($_POST['cbo_ativo']) ? 1 : 0;

    if ($ID == 0) {
        $sql = $con -> prepare("
            INSERT INTO produtos (
                nome
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
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $sql -> bind_param(
            "ssddddiiisi"
            , $nome
            , $descricao
            , $preco_atual
            , $altura
            , $largura
            , $profundidade
            , $peso
            , $destaque
            , $id_categoria
            , $caminho_imagem
            , $ativo
        );
    } else {
        $sql = $con -> prepare("
            UPDATE produtos SET
                nome = ?
                , descricao = ?
                , preco_atual = ?
                , altura = ?
                , largura = ?
                , profundidade = ?
                , peso = ?
                , destaque = ?
                , id_categoria = ?
                , caminho_imagem = ?
                , ativo = ?
            WHERE 
                id_produto = ?
        ");

        $sql -> bind_param(
            "ssddddiiisii"
            , $nome
            , $descricao
            , $preco_atual
            , $altura
            , $largura
            , $profundidade
            , $peso
            , $destaque
            , $id_categoria
            , $caminho_imagem
            , $ativo
            , $ID
        );
    }

    if ($sql -> execute()) {
        echo
            "<script>
                alert('Produto gravado com sucesso.');
                window.location.href = '../../paginas/produtos.php';
            </script>";
    } else {
        echo
            "<script>
                alert('Erro ao salvar o produto: " . $sql -> error . "');
                window.location.href = '../../paginas/produtos.php';
            </script>";
    }

    $sql -> close();
    $con -> close();
?>