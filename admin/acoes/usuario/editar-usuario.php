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

    $id_usuario         = intval($_GET['id_usuario']);
    $nome               = $_POST['txt_nome'];
    $email              = $_POST['txt_email'];
    $telefone           = $_POST['txt_telefone'];
    $admin              = isset($_POST['cbo_admin']) ? 1 : 0;
    $caminho_img_perfil = $_POST['txt_caminhoIM'];

    $sql = $con -> prepare("
        UPDATE usuarios SET
            nome_completo = ?
            , email = ?
            , telefone_celular = ?
            , admin = ?
            , caminho_img_perfil = ?
        WHERE 
            id_usuario = ?
    ");

    $sql -> bind_param(
        "sssisi"
        , $nome
        , $email
        , $telefone
        , $admin
        , $caminho_img_perfil
        , $id_usuario
    );

    if ($sql -> execute()) {
        echo
            "<script>
                alert('Usuário atualizado com sucesso.');
                window.location.href = '../../paginas/usuarios.php';
            </script>";
    } else {
        echo
            "<script>
                alert('Erro ao atualizar usuário: " . $sql -> error . "');
                window.location.href = '../../paginas/usuarios.php';
            </script>";
    }

    $sql -> close();
    $con -> close();
?>