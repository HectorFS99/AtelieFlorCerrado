<?php
    header('Content-Type: text/html; charset=utf-8');
?>
    <html lang="pt-br">
        <head>
            <?php include '/componentes/head.php'; ?>
            <link rel="stylesheet" href="./recursos/css/pagina-inicial.css">
            <link rel="stylesheet" href="./recursos/css/geral.css">
            <link rel="stylesheet" href="./recursos/css/materiais.css">
        </head> 
        <body>
            <?php include '/componentes/header.php'; ?>
            <main>
                <section id="section-materiais-sustentaveis" class="secao-pagina">
                    
                    <h1 class="titulo-pagina">MATERIAIS SUSTENTÁVEIS</h1>
                    <p class="subtitulo-pagina">A Beleza que Respeita a Natureza</p>

                    <div class="bloco-conteudo-imagem">
                        <img src="./recursos/imagens/materiais/fibras_destaque.jpg" alt="Fios e fibras naturais de algodão e juta" class="img-bastidores-grande">
                        </div>

                    <p class="paragrafo-secao-intro">No **Ateliê Flor do Cerrado**, acreditamos que a verdadeira beleza é aquela que não custa o planeta. A nossa paixão pelo artesanato está profundamente ligada ao nosso compromisso com a sustentabilidade e a responsabilidade socioambiental. Esta página é um convite para você conhecer as fibras que escolhemos e o porquê de cada uma ser essencial na nossa produção.</p>

                    <h2 class="subtitulo-secao">🌱 Fibras Naturais: O Coração da Nossa Produção</h2>
                    <p class="paragrafo-secao">Priorizamos o uso de fibras naturais, renováveis e biodegradáveis. Ao fazermos isso, garantimos que nossas bolsas tenham um impacto ambiental significativamente menor do que as produzidas com materiais sintéticos ou de origem não responsável.</p>

                    <h3 class="titulo-fibra">1. Juta: A Fibra do Baixo Impacto</h3>
                    <div class="detalhe-fibra-container">
                        <div class="detalhe-fibra-texto">
                            <p>A juta é a nossa estrela rústica. É uma fibra natural 100% biodegradável e altamente sustentável, cultivada predominantemente na Amazônia, o que reforça nossa valorização pela flora brasileira.</p>
                            <ul class="lista-detalhe-fibra">
                                <li>**Biodegradável:** Ao final de sua vida útil, a juta se decompõe naturalmente, retornando ao solo sem deixar resíduos tóxicos.</li>
                                <li>**Aliada do Meio Ambiente:** O seu cultivo é benéfico, pois as plantações de juta absorvem grandes quantidades de CO2 da atmosfera.</li>
                                <li>**Textura e Durabilidade:** Além de ecológica, confere às nossas peças uma textura rústica inconfundível, força e uma durabilidade que acompanha o tempo.</li>
                            </ul>
                        </div>
                        <div class="detalhe-fibra-imagem">
                            <img src="./recursos/imagens/materiais/juta_detalhe.jpg" alt="Fio de juta em detalhe">
                        </div>
                    </div>


                    <h3 class="titulo-fibra">2. Algodão: A Maciez Consciente</h3>
                    <div class="detalhe-fibra-container reverse"> <div class="detalhe-fibra-texto">
                            <p>Em complemento à juta, utilizamos o algodão em nossas tramas e nos forros internos, garantindo o toque macio e o conforto no uso.</p>
                            <ul class="lista-detalhe-fibra">
                                <li>**Algodão Orgânico e Reciclado:** Damos preferência ao **algodão orgânico**, cultivado sem o uso de agrotóxicos, e a fios de **algodão reciclado**, evitando descarte e tingimento excessivo.</li>
                                <li>**Dispensa Tingimento:** Optar por fios que já nascem em cores naturais, ou que vêm de reciclagem, economiza uma quantidade imensa de água e produtos químicos.</li>
                                <li>**Selo de Qualidade:** Buscamos fornecedores que possuam certificações de origem e práticas justas, honrando a cadeia produtiva do campo ao ateliê.</li>
                            </ul>
                        </div>
                        <div class="detalhe-fibra-imagem">
                             <img src="./recursos/imagens/materiais/algodao_detalhe.jpg" alt="Fio de algodão em detalhe">
                        </div>
                    </div>
                </section>
                
                <section id="section-cadeia-produtiva" class="secao-pagina secao-bege">
                    <h2 class="titulo-destaque">💚 Nossa Cadeia Produtiva</h2>
                    <p class="paragrafo-secao-intro">A sustentabilidade no Ateliê Flor do Cerrado vai além da matéria-prima. É uma filosofia que se estende por todo o nosso processo:</p>
                    
                    <ul class="lista-detalhes-verticais">
                        <li>**Comércio Justo:** Trabalhamos apenas com parceiros que valorizam o trabalho humano e oferecem condições éticas e seguras, apoiando o desenvolvimento local e a economia familiar.</li>
                        <li>**Embalagens Ecológicas:** Nossas embalagens são pensadas para o menor impacto possível, utilizando materiais reciclados, recicláveis e biodegradáveis. Menos plástico, mais natureza.</li>
                        <li>**Produção *Slow Fashion*:** Criamos peças duráveis e atemporais, indo na contramão do consumo descartável. Uma bolsa Flor do Cerrado é feita para durar e ser amada por muitos anos.</li>
                    </ul>

                    <h3 class="titulo-alma">O Seu Papel no Ciclo</h3>
                    <p class="paragrafo-secao">Ao escolher uma peça do Ateliê Flor do Cerrado, você se torna parte ativa deste ciclo virtuoso. Você está:</p>
                    
                     <ul class="lista-alma">
                        <li>**Valorizando** a arte e o tempo de um artesão.</li>
                        <li>**Reduzindo** a pegada ecológica no planeta.</li>
                        <li>**Investindo** em um produto que tem história, alma e um futuro sustentável.</li>
                    </ul>
                </section>

            </main>
            <?php include '/componentes/footer.php'; ?>
        </body>
    </html>