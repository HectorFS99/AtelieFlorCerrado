<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include '/componentes/adm_head.php'; ?>
        <title>Acessar Painel ADM.</title>
    </head>
    <body>
        <div class="container-login">
            <form method="post" id="formLogin" class="formulario" name="logar" onsubmit="autenticar(event);">
                <h3 class="mb-4 text-center">Acesse a sua conta</h3>
                <div class="form-floating mb-2">
                    <input name="email" type="email" class="form-control" placeholder="Email" required>
                    <label for="email">Email</label>
                </div>
                <div class="form-floating mb-2">
                    <input name="senha" type="password" class="form-control" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>
                <div class="btn-group-vertical w-100 mt-2">
                    <button id="btnEntrar" class="botao form-btn btn-confirmar w-100" type="submit">Entrar</button>
                </div>
            </form>
        </div>
    </body>
</html>