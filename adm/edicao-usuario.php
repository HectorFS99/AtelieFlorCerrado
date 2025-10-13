<?php
    $ID = 0;
    $usuario = null;

    // Buscar usuário pela API
    if (isset($_GET['id_usuario'])) {
        $ID = $_GET['id_usuario'];

        $url = "http://localhost:8080/usuarios/$ID";
        $json = @file_get_contents($url);

        if ($json !== false) {
            $usuario = json_decode($json, true);
        } else {
            echo "<script>alert('Usuário não encontrado!');window.location.href='adm_usuarios.php';</script>";
            exit;
        }
    }

    // Atualizar usuário via API
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $dados = array(
            "idUsuario" => $ID,
            "nomeCompleto" => isset($_POST['nomeCompleto']) ? $_POST['nomeCompleto'] : '',
            "cpf" => isset($_POST['cpf']) ? $_POST['cpf'] : '',
            "rg" => isset($_POST['rg']) ? $_POST['rg'] : '',
            "dataNascimento" => isset($_POST['dataNascimento']) ? $_POST['dataNascimento'] : '',
            "sexo" => isset($_POST['sexo']) ? $_POST['sexo'] : '',
            "telefoneCelular" => isset($_POST['telefoneCelular']) ? $_POST['telefoneCelular'] : '',
            "admin" => isset($_POST['admin']) ? filter_var($_POST['admin'], FILTER_VALIDATE_BOOLEAN) : false,
            "caminhoImgPerfil" => isset($_POST['caminhoImgPerfil']) ? $_POST['caminhoImgPerfil'] : '',
            "email" => isset($_POST['email']) ? $_POST['email'] : '',
            "senha" => isset($_POST['senha']) ? $_POST['senha'] : ''
        );

        $url = "http://localhost:8080/usuarios/atualizar/$ID";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($dados))
        ));

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode == 200) {
            echo "<script>alert('Usuário atualizado com sucesso!');window.location.href='adm_usuarios.php';</script>";
            exit;
        } else {
            echo "<script>alert('Erro ao atualizar usuário!');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php include '/componentes/head.php'; ?>
    <body>
        <?php include '/componentes/adm_header.php'; ?>
        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="adm_usuarios.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Novo Usuário
                </h3>
            </div>
            <form method="POST" name="form_ed_usuarios" class="formulario w-100">
                <input type="hidden" name="id_usuario" value="<?= htmlspecialchars(isset($usuario['idUsuario']) ? $usuario['idUsuario'] : '') ?>">
                <!-- Nome completo, CPF e RG -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="nomeCompleto" id="nomeCompleto" type="text" class="form-control" placeholder="Nome completo" value="<?= htmlspecialchars(isset($usuario['nomeCompleto']) ? $usuario['nomeCompleto'] : '') ?>" onfocusout="validarNome('nomeCompleto', 'nomeCompleto_erro');" required>
                        <label for="nomeCompleto">Nome completo:</label>
                        <div id="nomeCompleto_erro" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-floating">
                        <input name="cpf" id="cpf" type="text" class="form-control" placeholder="CPF" value="<?= htmlspecialchars(isset($usuario['cpf']) ? $usuario['cpf'] : '') ?>" onfocusout="validarCPF('cpf', 'cpf_erro');" maxlength="11" required>
                        <label for="cpf">CPF:</label>
                        <div id="cpf_erro" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-floating">
                        <input name="rg" id="rg" type="text" class="form-control" placeholder="RG" value="<?= htmlspecialchars(isset($usuario['rg']) ? $usuario['rg'] : '') ?>" maxlength="9" required>
                        <label for="rg">RG:</label>
                        <div id="rg_erro" class="invalid-feedback">
                        </div>                            
                    </div>
                </div>

                <!-- Data de nascimento, sexo e telefone celular -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="dataNascimento" id="dataNascimento" type="date" class="form-control" placeholder="Data de nascimento" value="<?= htmlspecialchars(isset($usuario['dataNascimento']) ? $usuario['dataNascimento'] : '') ?>" onfocusout="validarDataNascimento('dataNascimento', 'dataNascimento_erro');" min="1900-01-01" required>
                        <label for="dataNascimento">Data de nascimento:</label>
                        <div id="dataNascimento_erro" class="invalid-feedback">
                        </div>
                    </div>
                   <div class="form-floating">
                    <select name="sexo" id="sexo" class="form-select" required>
                    <option value="" <?= !isset($usuario['sexo']) || $usuario['sexo'] == '' ? 'selected' : '' ?>></option>
                    <option value="M" <?= isset($usuario['sexo']) && $usuario['sexo'] == 'M' ? 'selected' : '' ?>>Masculino</option>
                    <option value="F" <?= isset($usuario['sexo']) && $usuario['sexo'] == 'F' ? 'selected' : '' ?>>Feminino</option>
                    </select>
                    <label for="sexo">Sexo:</label>
                    </div>
                    <div class="form-floating">
                        <input name="telefoneCelular" id="telefoneCelular" type="text" class="form-control" placeholder="Telefone celular" value="<?= htmlspecialchars(isset($usuario['telefoneCelular']) ? $usuario['telefoneCelular'] : '') ?>" oninput="aplicarMascaraTelefone(this);" required>
                        <label for="telefoneCelular">Telefone celular:</label>
                    </div>
                </div>
                
                <!-- Admin e caminho da imagem de perfil -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <select name="admin" id="admin" class="form-select" required>
                        <option value="false" <?= isset($usuario['admin']) && $usuario['admin'] == 'false' ? 'selected' : '' ?>>Não</option>
                        <option value="true" <?= isset($usuario['admin']) && $usuario['admin'] == 'true' ? 'selected' : '' ?>>Sim</option>
                        </select>
                        <label for="admin">Administrador?</label>
                    </div>  
                    <div class="form-floating">
                        <input name="caminhoImgPerfil" id="caminhoImgPerfil" type="text" class="form-control" placeholder="Caminho da imagem de perfil" value="<?= htmlspecialchars(isset($usuario['caminhoImgPerfil']) ? $usuario['caminhoImgPerfil'] : '') ?>">
                        <label for="caminhoImgPerfil">Caminho da imagem de perfil:</label>
                    </div>
                </div>

                <!-- Email e senha -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="email" id="email" type="email" class="form-control" placeholder="E-mail" value="<?= htmlspecialchars(isset($usuario['email']) ? $usuario['email'] : '') ?>" onfocusout="validarEmail('email', 'email_erro');" required>
                        <label for="email">E-mail:</label>
                        <div id="email_erro" class="invalid-feedback">
                        </div>                            
                    </div>
                    <div class="form-floating">
                        <div class="form-floating m-0">
                            <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha" value="<?= htmlspecialchars(isset($usuario['senha']) ? $usuario['senha'] : '') ?>" onfocusout="validarCriteriosSenha('senha', 'senha_erro');" required>
                            <label for="senha">Senha:</label>
                        </div>
                        <div id="senha_erro" class="invalid-feedback">
                        </div>  
                        <p class="form-text mb-0 mt-2 text-white">A sua senha deve ter, no mínimo, 10 caracteres alfanuméricos, uma letra maiúscula e um caractere especial.</p>                          
                    </div>                  
                </div>

                <!-- Botões -->
                <div class="form-botoes">
                    <button onclick="window.location.href='adm_usuarios.php'" type="button" class="botao form-btn btn-cancelar">Cancelar</button>
                    <button type="submit" class="botao form-btn btn-confirmar">Confirmar</button>
                </div>
            </form>
        </main>
    </body>

</html>