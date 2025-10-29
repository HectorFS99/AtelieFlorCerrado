<?php
	header('Content-Type: text/html; charset=utf-8');
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Closet Virtual</title>
        <link rel="stylesheet" href="./recursos/css/closet.css">
        <link rel="stylesheet" href="./recursos/css/geral.css">
        <script src="./recursos/javascript/closet.js" defer></script>
    </head>

    <body>
        <div id="head">
            <p class="titulo-secao">Arraste as bolsas para vestir o modelo </p>
        </div>

        <div id="modelo"> 
            <img src="./recursos/imagens/closet/modelo.png" 
            alt="Modelo" 
            style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;"> 
        </div>

        <div class="franela" id="bolsa1">
            <img src="./recursos/imagens/closet/anamaria.png" alt="Bolsa Anamaria"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa2">
            <img src="./recursos/imagens/closet/beatriz.png" alt="Bolsa Beatriz"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa3">
            <img src="./recursos/imagens/closet/elisa.png" alt="Bolsa Elisa"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa4">
            <img src="./recursos/imagens/closet/isabel.png" alt="Bolsa Isabel"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa5">
            <img src="./recursos/imagens/closet/juliana.png" alt="Bolsa Juliana"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa6">
            <img src="./recursos/imagens/closet/luisa.png" alt="Bolsa Luisa"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa7">
            <img src="./recursos/imagens/closet/lurdes.png" alt="Bolsa Lurdes"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa8">
            <img src="./recursos/imagens/closet/mariaAlice.png" alt="Bolsa Maria Alice"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa9">
            <img src="./recursos/imagens/closet/regina.png" alt="Bolsa Regina"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa10">
            <img src="./recursos/imagens/closet/roberta.png" alt="Bolsa Roberta"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa11">
            <img src="./recursos/imagens/closet/rosangela.png" alt="Bolsa Rosângela"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa12">
            <img src="./recursos/imagens/closet/sayuri.png" alt="Bolsa Sayuri"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>
        <div class="franela" id="bolsa13">
            <img src="./recursos/imagens/closet/thelma.png" alt="Bolsa Thelma"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>     
        <div class="franela" id="bolsa14">
            <img src="./recursos/imagens/closet/jasmine.png" alt="Bolsa Thelma"
                style="width:100%;height:100%;object-fit:cover;border-radius:inherit;display:block;">
        </div>     


        <div id="closet">
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

        <footer>
            <p>&copy; 2025 <span>Ateliê Flor do Cerrado</span> | Moda com propósito 🌿</p>
        </footer>

    </body>

</html>