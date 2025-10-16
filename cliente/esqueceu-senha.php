<!DOCTYPE html>
<html lang="pt-br">
    <?php include '/componentes/head.php'; ?>
    <body>
        <header>
            <nav class="custom-navbar">
                <a href="pagina-inicial.php"><i class="fa-solid fa-arrow-left"></i></a>
                <span style="font-weight: 400;">Flor do Cerrado</span>
            </nav>
        </header>
        <main class="container">
            <form class="formulario" onsubmit="enviarCodigoRecuperacao(event);">
                <h4 class="mb-4">Iremos te enviar um link de segurança no e-mail informado.</h4>
                <div class="form-floating">
                    <input id="txtEmailLogin" type="email" class="form-control" placeholder="Email" required>
                    <label for="txtEmailLogin">Email</label>
                </div>
                <div class="btn-group-vertical w-100 mt-2">
                    <button class="btn btn-lg btn-cor-principal" type="submit">Confirmar</button>
                </div>
            </form>
        </main>
    </body>
</html>