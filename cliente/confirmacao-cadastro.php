<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include '/componentes/head.php'; ?>
        <link rel="stylesheet" href="/cliente/recursos/css/confirmacao-cadastro.css">
    </head>
    <body>
	    <?php include '/componentes/header.php'; ?>
        <main class="container vh-100 mt-0 flex-column">
            <span id="icone-confirmacao" class="fa-regular fa-circle-check" style="display: none;"></span>
            <span id="icone-carregamento" class="loader"></span>
            <h1 id="titulo" class="titulo-confirmacao mt-4">Quase lá!</h1>
            <p id="info" class="info-confirmacao">Enviamos um link de confirmação para o e-mail informado. Por favor, acesse-o para confirmar o seu cadastro.</p>
            <a href="#" id="btn" class="btn btn-lg btn-gradiente">Enviar novamente</a>
        </main>
    </body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(mudarConteudo, 10000);
        });

        function mudarConteudo() {
            var icone_carregamento = document.getElementById('icone-carregamento');
            icone_carregamento.style.display = 'none';
            var icone_confirmacao = document.getElementById('icone-confirmacao');
            icone_confirmacao.style.display = 'block';
            var titulo = document.getElementById('titulo');
            titulo.innerHTML = 'Confirmado!'
            var info = document.getElementById('info');
            info.innerHTML = 'Seja bem-vindo(a)! Explore o nosso catálogo e aproveite as nossas ofertas!'
            var btn = document.getElementById('btn');
            btn.innerHTML = 'Continuar'
            btn.setAttribute('href', 'pagina-inicial.php');
        }
    </script>
</html>