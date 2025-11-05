<?php
    session_start();

    include '../acoes/conectar-bd.php'; // agora contém $con = new mysqli(...)

    if (!isset($_SESSION['id_usuario'])) {
        echo "<script>
                alert('Usuário não autenticado. Você será redirecionado para a página inicial.');
                window.location.href = '../../cliente/pagina-inicial.php';
            </script>";

        exit();
    }

    $id_usuario = intval($_SESSION['id_usuario']);

    $sql = $con -> prepare("
        SELECT 
            nome_completo
            , telefone_celular
            , email
            , caminho_img_perfil
        FROM 
            usuarios
        WHERE 
            id_usuario = ?
    ");
    
    $sql -> bind_param("i", $id_usuario);
    $sql -> execute();

    $result = $sql -> get_result();
    $usuario = $result -> fetch_assoc();

    if (!$usuario) {
        die("Usuário não encontrado.");
    }
?>

<header class="cabecalho">
    <div>
        <h1>O que você deseja fazer?</h1>
        <span id="data-atual"></span>
    </div>
    <div class="dropdown">
        <button class="botao btn-usuario" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="mx-2"><?php echo $usuario['nome_completo']; ?></span>
            <img src="../<?php echo $usuario['caminho_img_perfil']; ?>">
        </button>
        <ul class="dropdown-menu">
            <li>
                <div class="info-usuario">
                    <span><?php echo $usuario['email']; ?></span>
                    <span><?php echo $usuario['telefone_celular']; ?></span>
                </div>
                <a class="dropdown-item" href="../../cliente/pagina-inicial.php">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>Sair
                </a>
            </li>
        </ul>
    </div>
</header>
<hr class="divisor">
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function formatarData(data) {
            const opcoesData = { day: 'numeric', month: 'long', year: 'numeric' };
            const dataFormatada = data.toLocaleDateString('pt-BR', opcoesData);
            
            const horas = String(data.getHours()).padStart(2, '0');
            const minutos = String(data.getMinutes()).padStart(2, '0');
            
            return `${dataFormatada} - ${horas}:${minutos}`;
        }

        const dataAtual = new Date();
        const elementoData = document.getElementById('data-atual');

        if (elementoData) {
            elementoData.textContent = formatarData(dataAtual);
        }
    });
</script>