<?php
    include '../conectar-bd.php';

    if (!isset($_GET['id_usuario'])) {
        echo
            "<script>
                alert('Usuário não informado.');
                window.location.href = '../../paginas/usuarios.php';
            </script>";
            
        exit();
    }

    $id_usuario = intval($_GET['id_usuario']);

    $sql = $con -> prepare("DELETE FROM usuarios WHERE id_usuario = ?");
    $sql -> bind_param(
        "i"
        , $id_usuario
    );

    if ($sql -> execute()) {
        echo
            "<script>
                alert('Usuário excluído com sucesso.');
                window.location.href = '../../paginas/usuarios.php';
            </script>";
    } else {
        echo
            "<script>
                alert('Erro ao excluir usuário: " . $sql -> error . "');
                window.location.href = '../../paginas/usuarios.php';
            </script>";
    }

    $sql -> close();
    $con -> close();
?>