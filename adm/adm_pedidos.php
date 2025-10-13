<html lang="pt-br">
    <head>
        <?php include '/componentes/adm_head.php'; ?>
        <title>Pedidos</title>
    </head>
    <body>
        <?php include '/componentes/adm_header.php'; ?>
        <main class="conteudo-principal">
            <div class="titulo-opcoes">
                <h3 class="titulo">
                    <a href="adm_index.php" class="btn-voltar"><i class="fa-solid fa-arrow-left"></i></a>
                    Pedidos
                </h3>
            </div>
            <div class="table-responsive">
                <table id="tabela-pedidos" class="table table-striped">
                    <!-- Cabeçalho da tabela -->
                    <thead>
                        <tr class="tabela-linha">
                            <th>ID</th>
                            <th>Dt. Pedido</th>
                            <th>Subtotal</th>
                            <th>Frete</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Dt. Entrega</th>
                            <th>Cliente</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <!-- Corpo da tabela -->
                    <tbody id="pedidos-tbody">
                    </tbody>
                </table>               
            </div>
        </main>
    </body>

    <script>
        function exibirInformacoesPedido(idConteudo, titulo, larguraModal) {
            var htmlConteudo = document.getElementById(idConteudo);

            popupSwal.fire({ 
                title: `<span style="text-shadow: none !important;">${titulo}<span>`
                , html: htmlConteudo.innerHTML
                , showConfirmButton: false
                , showCancelButton: true
                , cancelButtonText: "Fechar"
                , width: larguraModal
            });
        }

        function limitarNome(nome) {
            return nome.length > 30 ? nome.substring(0, 30) + "..." : nome;
        }

        function formatarMoeda(valor) {
            return `R$ ${parseFloat(valor).toFixed(2).replace('.', ',')}`;
        }

        function formatarDataHora(dataISO) {
            const data = new Date(dataISO);
            return data.toLocaleString('pt-BR');
        }
        
        function renderizarPedidos(pedidos) {
            const tbody = document.getElementById('pedidos-tbody');
            tbody.innerHTML = '';

            pedidos.forEach(pedido => {
                const idPedido = pedido.idPedido; // Atenção aqui ao nome correto da chave
                const dataPedido = formatarDataHora(pedido.dtPedido);
                const subtotal = formatarMoeda(pedido.subtotal);
                const frete = formatarMoeda(pedido.frete);
                const total = formatarMoeda(pedido.total);
                const status = pedido.statusPedido;
                const dataEntrega = pedido.dtEntrega ? formatarDataHora(pedido.dtEntrega) : 'Não definida.';
                const nomeCliente = pedido.nomeCompleto;
                const formaPagamento = pedido.formaPagamento;
                const numeroCartao = pedido.numeroCartao;
                const parcelas = pedido.parcelas;
                const endereco = pedido.endereco;
                const enderecoLoja = pedido.enderecoLoja;
                const email = pedido.email;
                const telefone = pedido.telefoneCelular;

                const modalDetalhesId = `detalhesPedido_${idPedido}`;
                const modalProdutosId = `produtosPedido_${idPedido}`;
                const produtosTbodyId = `produtos-tbody-${idPedido}`;

                tbody.innerHTML += `
                    <tr class="tabela-linha">
                        <td>${idPedido}</td>
                        <td>${dataPedido}</td>
                        <td>${subtotal}</td>
                        <td>${frete}</td>
                        <td>${total}</td>
                        <td>${status}</td>
                        <td>${dataEntrega}</td>
                        <td>${nomeCliente}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-around">
                                <button class="btn-tabela btn-informacoes" onclick="exibirInformacoesPedido('${modalDetalhesId}', 'Detalhes do pedido ${idPedido}', '800px')">
                                    <i class="fa-solid fa-circle-info"></i>
                                </button>
                                
                                <button class="btn-tabela btn-produtos" onclick="exibirInformacoesPedido('${modalProdutosId}', 'Produtos do pedido ${idPedido}', '1300px')">
                                    <i class="fa-solid fa-cubes"></i>
                                </button>

                                <div id="${modalDetalhesId}" style="display: none;">
                                    <div class="container-detalhes_ped">
                                        <div class="detalhes_ped-coluna">
                                            ${endereco ? `
                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-truck-fast"></i> Enviar para</h4>
                                                    <p>${endereco}</p>
                                                </div>` : `
                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-box"></i> Retirar em</h4>
                                                    <p>${enderecoLoja}</p>
                                                </div>`}
                                            
                                            <div class="mb-4">
                                                <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-at"></i> E-mail do Cliente</h4>
                                                <a href="mailto:${email}">${email}</a>
                                            </div>
                                            
                                            <div class="mb-4">
                                                <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-phone"></i> Telefone para Contato</h4>
                                                <p>${telefone}</p>
                                            </div>
                                        </div>

                                        <div class="detalhes_ped-coluna">
                                            <div class="mb-4">
                                                <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-file-invoice-dollar"></i> Forma de Pagamento</h4>
                                                <p>${formaPagamento}</p>
                                            </div>

                                            ${numeroCartao ? `
                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-credit-card"></i> Número do Cartão</h4>
                                                    <p>Terminado em ${numeroCartao}</p>
                                                </div>
                                                <div class="mb-4">
                                                    <h4 class="detalhes_ped-titulo_info"><i class="fa-solid fa-layer-group"></i> Parcelado em</h4>
                                                    <p>${parcelas}x</p>
                                                </div>` : ''}
                                        </div>
                                    </div>
                                </div>

                                <div id="${modalProdutosId}" style="display: none;">
                                    <table id="tabela-produtos_${idPedido}" class="table table-striped text-center align-middle">
                                        <thead>
                                            <tr class="tabela-linha">
                                                <th width="5%">ID</th>
                                                <th width="10%">Imagem</th>
                                                <th>Nome</th>
                                                <th>Pre. anterior</th>
                                                <th>Preço atual</th>
                                                <th>Destaque?</th>
                                                <th width="10%">Oferta?</th>
                                                <th>Categoria</th>
                                            </tr>
                                        </thead>
                                        <tbody id="${produtosTbodyId}">
                                            <!-- Produtos serão adicionados via JS -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                `;

                pedido.produtosPorPedido.forEach(produto => {
                    const linhaProduto = `
                        <tr class="tabela-linha">
                            <td>${produto.idProduto}</td>
                            <td><img src="${produto.caminhoImagem}" width="50"/></td>
                            <td>${produto.nome}</td>
                            <td>${formatarMoeda(produto.precoAnterior)}</td>
                            <td>${formatarMoeda(produto.precoAtual)}</td>
                            <td>${produto.destaque ? 'Sim' : 'Não'}</td>
                            <td>${produto.ofertaRelampago ? 'Sim' : 'Não'}</td>
                            <td>${produto.categoriaNome || '-'}</td>
                        </tr>`;

                    document.getElementById(produtosTbodyId).innerHTML += linhaProduto;
                });
            });

            transformarTabela('#tabela-pedidos');
        }

        document.addEventListener('DOMContentLoaded', function () {
            fetch('http://localhost:8080/pedidos/todos')
            .then(response => response.json())
            .then(data => renderizarPedidos(data))
            .catch(error => {
                document.getElementById('pedidos-tbody').innerHTML = '<tr><td colspan="9">Erro ao carregar pedidos.</td></tr>';
            });
        });
    </script>
</html>