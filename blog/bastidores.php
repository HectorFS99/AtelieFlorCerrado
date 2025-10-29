<?php
    header('Content-Type: text/html; charset=utf-8');
?>
    <html lang="pt-br">
        <head>
            <?php include '/componentes/head.php'; ?>
            <link rel="stylesheet" href="./recursos/css/pagina-inicial.css">
            <link rel="stylesheet" href="./recursos/css/geral.css">
            <link rel="stylesheet" href="./recursos/css/bastidores.css">
        </head> 
        <body>
            <?php include '/componentes/header.php'; ?>
            <main>
                <section id="section-bastidores" class="secao-pagina">
                    
                    <h2 class="titulo-secao">BASTIDORES</h2>
                    <p class="subtitulo-pagina">Um olhar nos bastidores do nosso trabalho</p>

                    <div class="bloco-conteudo-imagem">
                        <img src="./recursos/imagens/bastidores/producao.jpg" alt="Mulher artesã tecendo crochê com fio natural" class="img-bastidores-grande">
                        </div>

                    <h2 class="subtitulo-secao">✨ A Arte de Fazer à Mão</h2>
                    <p class="paragrafo-secao">Nossas bolsas são o resultado de um processo que honra as técnicas ancestrais, combinado com um olhar moderno e sustentável. Cada ponto é dado com intenção, garantindo que a peça que chega até você seja perfeita em sua imperfeição artesanal.</p>
                    
                    <ul class="lista-check">
                        <li>**O Crochê e a Trama:** É no ritmo do crochê que a fibra ganha forma. É um trabalho de atenção plena, onde a concentração e a paciência se unem para criar a estrutura e o design de cada bolsa.</li>
                        <li>**A Inspiração:** A beleza e a força do **Cerrado**, nosso bioma, são a nossa fonte inesgotável de inspiração. Cores, texturas e a resistência da flora se refletem em cada design.</li>
                        <li>**O Toque Final:** Depois de pronta, cada peça passa por uma curadoria rigorosa para garantir a qualidade, o acabamento perfeito e a durabilidade. Alças, forros e detalhes são costurados à mão, adicionando um toque final de exclusividade.</li>
                    </ul>

                </section>
                
                <section id="section-materiais" class="secao-pagina secao-bege">
                    
                    <div class="layout-duas-colunas">
                        
                        <div class="texto-coluna">
                            <h2 class="titulo-secao">MATERIAIS SUSTENTÁVEIS</h2>
                            <p class="paragrafo-secao">A sustentabilidade não é uma tendência para o Ateliê Flor do Cerrado, é um pilar. Acreditamos que a beleza não pode custar o planeta. Por isso, somos rigorosos na escolha dos nossos materiais.</p>
                            
                            <ul class="lista-materiais">
                                <li>**Algodão e Juta:** Nossa produção utiliza predominantemente fibras naturais como o **algodão** e a **juta**.</li>
                                <li>São materiais que se destacam por serem **biodegradáveis** e **ecologicamente corretos**.</li>
                                <li>**Parcerias Éticas:** Buscamos fornecedores que compartilham a nossa visão de responsabilidade social e ambiental, valorizando a cadeia produtiva e o trabalho justo.</li>
                            </ul>
                            
                            <a href="#" class="btn-saiba-mais">SAIBA MAIS</a>
                        </div>
                        
                        <div class="imagem-coluna">
                            <img src="./recursos/imagens/bastidores/fibras.jpg" alt="Rolos e feixes de fibras naturais de juta e algodão" class="img-materiais">
                        </div>
                        
                    </div>
                </section>
                
            </main>
            <?php include '/componentes/footer.php'; ?>
        </body>
    </html>