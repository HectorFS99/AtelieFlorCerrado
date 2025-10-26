<?php     
    if (!isset($_SESSION['id_usuario'])) {
        echo 
            "<script>
                alert('Usuário não autenticado. Você será redirecionado para a página inicial.')
                window.location.href = '../pagina-inicial.php';
            </script>";
        
        exit;
    }

    $id_usuario = $_SESSION['id_usuario'];
    
    $sql_usuario = mysql_query(
        "SELECT 
            nome_completo
            , cpf
            , rg
            , dt_nascimento
            , sexo	
            , telefone_celular	
            , email	
            , caminho_img_perfil
            , admin
        FROM
            usuarios
        WHERE 
            id_usuario = $id_usuario");

    $usuario = mysql_fetch_assoc($sql_usuario);
?>