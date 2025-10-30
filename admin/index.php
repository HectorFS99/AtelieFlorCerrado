<!DOCTYPE html>
<html lang="pt-br">
    <head>        
        <?php include '/componentes/head.php'; ?>
        <link rel="stylesheet" href="recursos/css/index.css" />
        <title>Painel Administrativo</title>
    </head>
    <body>
	    <?php include '/componentes/header.php'; ?>
        <main class="conteudo-principal">
            <div class="container-opcoes">
                <h3>Gerenciar</h3>
                <div class="opcoes-gerenciamento">
                    <a href="produtos.php" class="opc-geren">
                        <i class="fa-solid fa-cube"></i>
                        <span>Produtos</span>
                    </a>
                    <a href="categorias.php" class="opc-geren">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Categorias</span>
                    </a>
                    <a href="pedidos.php" class="opc-geren">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Pedidos</span>
                    </a>
                    <a href="usuarios.php" class="opc-geren">
                        <i class="fa-solid fa-users"></i>
                        <span>Usuarios</span>
                    </a>
                </div>                
            </div>
        </main>
    </body>
</html>