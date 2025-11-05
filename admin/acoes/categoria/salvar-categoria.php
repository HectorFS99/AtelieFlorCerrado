<?php
    include '../conectar-bd.php';

    $ID          = isset($_GET['id_categoria']) ? intval($_GET['id_categoria']) : 0;
    $nome        = $_POST['nome'];
    $descricao   = $_POST['descricao'];

    if ($ID == 0) {
        $sql = $con -> prepare("
            INSERT INTO categorias (
                nome
                , descricao
            ) VALUES (?, ?)
        ");

        $sql -> bind_param(
            "ss"
            , $nome
            , $descricao
        );
    } else {
        $sql = $con -> prepare("
            UPDATE categorias SET
                nome = ?
                , descricao = ?
            WHERE 
                id_categoria = ?
        ");

        $sql -> bind_param(
            "ssi"
            , $nome
            , $descricao
            , $ID
        );
    }

    if ($sql -> execute()) {
        echo
            "<script>
                alert('Categoria salva com sucesso.');
                window.location.href = '../../paginas/categorias.php';
            </script>";
    } else {
        echo
            "<script>
                alert('Erro ao salvar categoria: " . $sql -> error . "');
                window.location.href = '../../paginas/categorias.php';
            </script>";
    }

    $sql -> close();
    $con -> close();
?>