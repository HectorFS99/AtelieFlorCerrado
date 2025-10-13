<html lang="pt-br">
    <head>
        <?php include '/componentes/adm_head.php'; ?>
        <title>Categorias</title>
    </head>
    <body>
        <?php include '/componentes/adm_header.php'; ?>
        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="adm_index.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Categorias
                </h3>
                <button onclick="window.location.href= 'cadastro-categoria.php'" class="botao btn-adicionar">
                    <i class="fa-solid fa-square-plus"></i> Adicionar
                </button>
            </div>
            <div class="table-responsive">
                <table id="tabela-categoria" class="table table-striped">
                    <thead>
                        <tr class="tabela-linha">
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Ícone</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="categorias-tbody">
                    </tbody>
                </table>               
            </div>
        </main>
    </body>
    <script>
        function limitarNome(nome) {
            return nome.length > 30 ? nome.substring(0, 30) + "..." : nome;
        }

        function renderizarCategorias(categorias) {
            const tbody = document.getElementById('categorias-tbody');
            tbody.innerHTML = '';
            
            categorias.forEach(linha => {
                tbody.innerHTML += `
                    <tr class="tabela-linha">
                        <td>${linha.idCategoria}</td>
                        <td>${limitarNome(linha.nome)}</td>
                        <td>${linha.descricao}</td>
                        <td>
                            <div>
                                <img src="${linha.caminhoIcone}" width="50"/>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center justify-content-between">
                                <a class="btn-tabela btn-excluir" onclick="excluirCategoria(${linha.idCategoria})">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                <a class="btn-tabela btn-editar" href="edicao-categoria.php?id_categoria=${linha.idCategoria}">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                `;
            });

            transformarTabela('#tabela-categoria');
        }

        async function excluirCategoria(idCategoria) {
            if (confirm('Tem certeza que deseja excluir esta categoria?')) {
                try {
                    const url = `http://localhost:8080/categorias/${idCategoria}`;
                    
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            
                        }
                    });

            if (response.ok) {
                
                const row = document.querySelector(`tr[data-id="${idCategoria}"]`);
                if (row) {
                    row.remove();
                    alert('Categoria excluída com sucesso!');
                }
            } else {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Falha ao excluir categoria');
            }
        } catch (error) {
            console.error('Erro:', error);
            alert('Erro ao excluir categoria');
                }
            }
        }
        document.addEventListener('DOMContentLoaded', function () {
            fetch('http://localhost:8080/categorias/todos')
            .then(response => response.json())
            .then(data => renderizarCategorias(data))
            .catch(error => {
                document.getElementById('categorias-tbody').innerHTML = '<tr><td colspan="9">Erro ao carregar categorias.</td></tr>';
            });
        });
    </script>
</html>