<?php
    header('Content-Type: text/html; charset=utf-8');
    date_default_timezone_set('America/Sao_Paulo');

    include '/acoes/conexao.php';
    session_start();
        
    $sql_quantidade_itens_carrinho = mysql_query("SELECT COUNT(DISTINCT `id_produto`) AS quantidade_itens_unicos FROM `carrinho`");
    
    $quantidade_itens = 0; 
    if ($row = mysql_fetch_assoc($sql_quantidade_itens_carrinho)) {
        $quantidade_itens = $row['quantidade_itens_unicos'];
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
            <a id="btnCarrinho" href="carrinho.php" class="btn btn-contorno">
                <i class="fa-solid fa-cart-shopping"></i>
                <span id="contador-carrinho" style="margin-left: 1rem;"><?php echo $quantidade_itens; ?></span>
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