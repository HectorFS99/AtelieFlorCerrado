<!DOCTYPE html>
<html lang="pt-br">
    <?php include '/componentes/head.php'; ?>
    <body>
        <?php include '/componentes/adm_header.php'; ?>
        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="adm_produtos.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Novo Usuário
                </h3>
            </div>
            <form method="POST" id="form_cad_usuarios" name="form_cad_usuarios" class="formulario w-100"
                onsubmit="adicionarRegistro(event, 'form_cad_usuarios', 'http://localhost:8080/usuarios/criar', 'adm_usuarios.php');">
                
                <!-- Nome completo, CPF e RG -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="nomeCompleto" id="nomeCompleto" type="text" class="form-control" placeholder="Nome completo" onfocusout="validarNome('nomeCompleto', 'nomeCompleto_erro');" required>
                        <label for="nomeCompleto">Nome completo:</label>
                        <div id="nomeCompleto_erro" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-floating">
                        <input name="cpf" id="cpf" type="text" class="form-control" placeholder="CPF" onfocusout="validarCPF('cpf', 'cpf_erro');" maxlength="11" required>
                        <label for="cpf">CPF:</label>
                        <div id="cpf_erro" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-floating">
                        <input name="rg" id="rg" type="text" class="form-control" placeholder="RG" maxlength="9" required>
                        <label for="rg">RG:</label>
                        <div id="rg_erro" class="invalid-feedback">
                        </div>                            
                    </div>
                </div>

                <!-- Data de nascimento, sexo e telefone celular -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="dataNascimento" id="dataNascimento" type="date" class="form-control" placeholder="Data de nascimento" onfocusout="validarDataNascimento('dataNascimento', 'dataNascimento_erro');" min="1900-01-01" required>
                        <label for="dataNascimento">Data de nascimento:</label>
                        <div id="dataNascimento_erro" class="invalid-feedback">
                        </div>
                    </div>
                    <div class="form-floating">
                        <select name="sexo" id="sexo" class="form-select" required>
                            <option value =""></option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                        </select>
                        <label for="sexo">Sexo:</label>
                    </div>
                    <div class="form-floating">
                        <input name="telefoneCelular" id="telefoneCelular" type="text" class="form-control" placeholder="Telefone celular" oninput="aplicarMascaraTelefone(this);" required>
                        <label for="telefoneCelular">Telefone celular:</label>
                    </div>
                </div>
                
                <!-- Admin e caminho da imagem de perfil -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <select name="admin" id="admin" class="form-select" required>
                            <option value="false">Não</option>
                            <option value="true">Sim</option>
                        </select>
                        <label for="admin">Administrador?</label>
                    </div>  
                    <div class="form-floating">
                        <input name="caminhoImgPerfil" id="caminhoImgPerfil" type="text" class="form-control" placeholder="Caminho da imagem de perfil">
                        <label for="caminhoImgPerfil">Caminho da imagem de perfil:</label>
                    </div>
                </div>

                <!-- Email e senha -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="email" id="email" type="email" class="form-control" placeholder="E-mail" onfocusout="validarEmail('email', 'email_erro');" required>
                        <label for="email">E-mail:</label>
                        <div id="email_erro" class="invalid-feedback">
                        </div>                            
                    </div>
                    <div class="form-floating">
                        <div class="form-floating m-0">
                            <input name="senha" id="senha" type="password" class="form-control" placeholder="Senha" onfocusout="validarCriteriosSenha('senha', 'senha_erro');" required>
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
<script>
    async function adicionarRegistro(event, formId, apiUrl, redirectUrl) {
    event.preventDefault();
    
    try {
        const form = document.getElementById(formId);
        const formData = new FormData(form); 

        const response = await fetch(apiUrl, {
            method: 'POST',
            body: formData 
        });

        if (!response.ok) {
            const errorData = await response.text();
            throw new Error(errorData || 'Erro ao cadastrar categoria');
        }

        alert('Cadastro realizado com sucesso!');
        window.location.href = redirectUrl;

    } catch (error) {
        console.error('Erro detalhado:', error);
        alert(`Falha no cadastro: ${error.message}\n\nVerifique o console para mais detalhes (F12)`);
    }
}
</script>
</html>