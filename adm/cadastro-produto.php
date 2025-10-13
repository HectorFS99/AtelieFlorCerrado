<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include '/componentes/adm_head.php'; ?>
        <title>Adicionar Produtos</title>
    </head>
    <body>
        <?php include '/componentes/adm_header.php'; ?>
        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="adm_produtos.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Novo Produto
                </h3>
            </div>
            <form method="POST" id="form_cad_produtos" name="form_cad_produtos" class="formulario w-100" onsubmit="adicionarRegistro(event, 'form_cad_produtos', 'http://localhost:8080/produtos/criar', 'adm_produtos.php');">
                <!-- Nome, preço anterior e preço atual -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="nome" type="text" required class="form-control" placeholder="Nome completo">
                        <label for="nome">Nome:</label>
                    </div>
                    <div class="form-floating">
                        <input name="precoAnterior" type="text" required class="form-control" placeholder="Preço anterior">
                        <label for="precoAnterior">Preço anterior:</label>
                    </div>
                    <div class="form-floating">
                        <input name="precoAtual" type="text" required class="form-control" placeholder="Preço atual">
                        <label for="precoAtual">Preço atual:</label>
                    </div>
                </div>

                <!-- Altura, largura, profundidade e peso -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <input name="altura" type="text" required class="form-control" placeholder="Altura">
                        <label for="altura"> Altura (cm):</label>
                    </div>
                    <div class="form-floating">
                        <input name="largura" type="text" required class="form-control" placeholder="Largura">
                        <label for="largura">Largura (cm):</label>
                    </div>
                    <div class="form-floating">
                        <input name="profundidade" type="text" required class="form-control" placeholder="Profundidade">
                        <label for="profundidade">Profundidade (cm):</label>
                    </div>
                    <div class="form-floating">
                        <input name="peso" type="text" required class="form-control" placeholder="Peso">
                        <label for="peso">Peso (kg):</label>
                    </div>
                </div>

                <!-- Descrição -->
                <div class="form-floating">
                    <textarea name="descricao" required class="form-control" rows="6" placeholder="Descrição do produto"></textarea>
                    <label for="descricao">Descrição:</label>
                </div>

                <!-- Categoria, destaque, oferta relâmpago e ativo/desativo -->
                <div class="formulario-grupo">
                    <div class="form-floating">
                        <select name="categoria.idCategoria" class="form-select">
                            <option></option>
                            <option value="1">Escritório</option>
                            <option value="2">Quarto</option>
                            <option value="3">Cozinha</option>
                            <option value="4">Sala de Jantar</option>
                            <option value="5">Área Externa</option>
                            <option value="6">Sala de Estar</option>
                        </select>
                        <label for="categoria.idCategoria">Selecione a categoria:</label>
                    </div>
                    <div class="form-floating">
                        <select name="destaque" class="form-select">
                            <option></option>
                            <option value="true">Sim</option>
                            <option value="false">Não</option>
                        </select>
                        <label for="destaque">Colocar em destaque?</label>
                    </div>
                    <div class="form-floating">
                        <select name="ofertaRelampago" class="form-select">
                            <option></option>
                            <option value="true">Sim</option>
                            <option value="false">Não</option>
                        </select>
                        <label for="ofertaRelampago">É oferta relâmpago?</label>
                    </div>
                    <div class="form-floating">
                        <select name="ativo" class="form-select">
                            <option value="true">Sim</option>
                            <option value="false">Não</option>
                        </select>
                        <label for="ativo">O produto estará ativo?</label>
                    </div>
                </div>

                <!-- Caminho da imagem -->
                <div class="form-floating">
                    <input name="caminhoImagem" type="text" required class="form-control" placeholder="Caminho da imagem">
                    <label for="caminhoImagem">Caminho da imagem:</label>
                </div>

                <div class="form-botoes">
                    <button onclick="window.location.href='adm_produtos.php'" class="botao form-btn btn-cancelar">Cancelar</button>
                    <button type="submit" value="Cadastrar" class="botao form-btn btn-confirmar">Confirmar</button>
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