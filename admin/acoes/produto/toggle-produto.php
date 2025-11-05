<?php
    include '../conectar-bd.php';

    if (!isset($_GET['id_produto'])) {
        echo
            "<script>
                alert('Item não informado.');
                window.location.href = '../../paginas/produtos.php';
            </script>";
        exit();
    }

    $id_produto = intval($_GET['id_produto']);

    $sql = $con -> prepare("SELECT ativo FROM produtos WHERE id_produto = ?");
    $sql -> bind_param("i", $id_produto);
    $sql -> execute();

    $resultado = $sql -> get_result();
    $produto = $resultado -> fetch_assoc();

    if (!$produto) {
        echo
            "<script>
                alert('Item não encontrado.');
                window.location.href = '../../paginas/produtos.php';
            </script>";
        exit();
    }

    $novoStatus = $produto['ativo'] ? 0 : 1;

    $sql = $con -> prepare("UPDATE produtos SET ativo = ? WHERE id_produto = ?");
    $sql -> bind_param("ii", $novoStatus, $id_produto);

    if ($sql -> execute()) {
        $mensagem = $novoStatus ? 'Item ativado com sucesso.' : 'Item desativado com sucesso.';
        echo
            "<script>
                alert('$mensagem');
                window.location.href = '../../paginas/produtos.php';
            </script>";
    } else {
        echo
            "<script>
                alert('Erro ao alterar status deste item: " . $sql -> error . "');
                window.location.href = '../../paginas/produtos.php';
            </script>";
    }

    $sql -> close();
    $con -> close();
?>