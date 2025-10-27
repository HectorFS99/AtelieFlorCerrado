<?php
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('America/Sao_Paulo');

    include '/acoes/conexao.php';
    session_start();

    $qtd_carr = null; 
    $qtd_fav = null;

    if (isset($_SESSION['id_usuario'])) {
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

        $sql_qtd_carr = mysql_query("SELECT COUNT(DISTINCT `id_produto`) AS sql_qtd_carr FROM `carrinho` WHERE `id_usuario` = $id_usuario");
        $sql_qtd_fav = mysql_query("SELECT COUNT(DISTINCT `id_produto`) AS sql_qtd_fav FROM `favoritos` WHERE `id_usuario` = $id_usuario");

        if ($row = mysql_fetch_assoc($sql_qtd_carr)) {
            $qtd_carr = $row['sql_qtd_carr'];
        }

        if ($row = mysql_fetch_assoc($sql_qtd_fav)) {
            $qtd_fav = $row['sql_qtd_fav'];
        }
    } else {
        $qtd_carr = 0; 
        $qtd_fav = 0;
    }
?>

<header>
    <nav class="navbar">
        <a href="pagina-inicial.php" style="width: 70px;">
            <img src="/cliente/recursos/imagens/logos/AtelieFlorDoCerrado.png" width="70px" />
        </a>
        <div class="btns_barra_superior">
            <a href="pagina-inicial.php" class="btn-vertical">
                <span>HOME</span>
            </a>
            <a href="listagem-geral-produtos.php" class="btn-vertical">
                <span>PRODUTOS</span>
            </a>
            <a href="#" class="btn-vertical">
                <span>GALERIA</span>
            </a>
            <a href="sobre.php" class="btn-vertical">
                <span>SOBRE NÓS</span>
            </a>
            <a href="carrinho.php" class="btn btn-contorno">
                <i class="fa-solid fa-cart-shopping"></i>
                <?php if ($qtd_carr != null) { echo "<span id=\"contador-obj\">$qtd_carr</span>"; } ?>
            </a>            
            <a href="favoritos.php" class="btn btn-contorno">
                <i class="fa-solid fa-heart"></i>
                <?php if ($qtd_fav != null) { echo "<span id=\"contador-obj\">$qtd_fav</span>"; } ?>
            </a>
        </div>

        <?php if (isset($_SESSION['autenticado']) && isset($_SESSION['id_usuario']) > 0) { 
            include '/acoes/selecionar_usuario.php';
        ?>
            <a href="#" onclick="window.location.href='./acoes/verifica_login.php'; return false;" class="btn-minha-conta">
                <img src="<?php echo $usuario['caminho_img_perfil']; ?>">         
            </a>                     
        <?php } else { ?>
            <a href="login.php" class="btn-vertical btn-contorno">
                <span>LOGIN</span>
            </a>                               
        <?php } ?>        
    </nav>
</header>