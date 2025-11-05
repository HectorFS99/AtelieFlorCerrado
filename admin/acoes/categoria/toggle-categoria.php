<?php
    include '../conectar-bd.php';

    if (!isset($_GET['id_categoria'])) {
        echo
            "<script>
                alert('Item não informado.');
                window.location.href = '../../paginas/categorias.php';
            </script>";
        exit();
    }

    $id_categoria = intval($_GET['id_categoria']);

    $sql = $con -> prepare("SELECT ativo FROM categorias WHERE id_categoria = ?");
    $sql -> bind_param("i", $id_categoria);
    $sql -> execute();

    $resultado = $sql -> get_result();
    $categoria = $resultado -> fetch_assoc();

    if (!$categoria) {
        echo
            "<script>
                alert('Item não encontrado.');
                window.location.href = '../../paginas/categorias.php';
            </script>";
        exit();
    }

    $novoStatus = $categoria['ativo'] ? 0 : 1;

    $sql = $con -> prepare("UPDATE categorias SET ativo = ? WHERE id_categoria = ?");
    $sql -> bind_param("ii", $novoStatus, $id_categoria);

    if ($sql -> execute()) {
        $mensagem = $novoStatus ? 'Item ativado com sucesso.' : 'Item desativado com sucesso.';
        echo
            "<script>
                alert('$mensagem');
                window.location.href = '../../paginas/categorias.php';
            </script>";
    } else {
        echo
            "<script>
                alert('Erro ao alterar status deste item: " . $sql -> error . "');
                window.location.href = '../../paginas/categorias.php';
            </script>";
    }

    $sql -> close();
    $con -> close();
?>