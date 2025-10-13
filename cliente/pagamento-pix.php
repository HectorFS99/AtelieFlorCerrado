<!DOCTYPE html>
<html lang="pt-br">
    <?php include '/componentes/head.php'; ?>
    <body>
   	    <?php include '/componentes/header_simples_2.php'; ?>     
        <main class="custom-main mb-4">
            <div class="coluna-1 col-1_pagamento">
                <div class="info-container d-flex align-items-center justify-content-between">
                    <div class="div-pedido_info">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-box" style="font-size: 2rem; color: var(--cor-principal); padding-right: .5rem;"></i>
                            <div>
                                <h6>Número do Pedido</h6>
                                <p>123456789</p>
                            </div>
                        </div>
                        <a href="perfil-usuario.php" class="btn btn-cor-principal"><b>ACOMPANHAR!</b></a>
                    </div>
                </div>
                <div class="info-container">
                    <div class="pix-pagamento_titulo">
                        <h5>
                            <i class="fa-brands fa-pix"></i> 
                            Pagamento via Pix                        
                        </h5>
                        <h4><b>R$ 2.609,97</b></h4>
                    </div>
                    <div class="pix-pagamento_conteudo">
                        <div class="pix-pagamento_col">
                            <div class="pix_pagamento_passo">
                                <i class="bi bi-1-circle"></i>
                                <span>Abra o app ou banco de sua preferência. Escolha a opção pagar com código Pix “copia e cola”, ou código QR.</span>
                            </div>
                        </div>
                        <div class="pix-pagamento_col">
                            <div class="pix_pagamento_passo">
                                <i class="bi bi-2-circle"></i>
                                <span>Copie e cole o código, ou escaneie o código QR com a câmera do seu celular. Confira todas as informações e autorize o pagamento.</span>
                            </div>
                            <div class="qrcode">
                                <img src="recursos/imagens/qrcode/pix-imaginario.png">
                                <button class="btn btn-pix"> Copiar código Pix</button>                            
                            </div>
                            <small><b>O código estará disponível por 24h.</b></small>
                        </div>
                        <div class="pix-pagamento_col">
                            <div class="pix_pagamento_passo">
                                <i class="bi bi-3-circle"></i>
                                <span>Você vai receber a confirmação de pagamento no seu e-mail e através dos nossos canais. E pronto!</span>
                            </div>                        
                        </div>
                    </div>                
                </div>
                <div class="w-100 text-center mt-3">
                    <small>Se o pagamento não for efetuado, o pedido será cancelado automaticamente.</small>
                </div>
            </div>
            <div class="coluna-2 col-2_pagamento">
                <div class="info-container">
                    <div class="div-endereco_titulo">
                        <h5><i class="fa-solid fa-truck-ramp-box"></i> Endereço de Entrega</h5>
                    </div>
                    <div class="div-endereco_atual">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <h6>Casa do José</h6>
                            <p>Rua Josefina Silva, 251, Mauá</p>
                        </div>
                    </div>
                </div>
                <div class="info-container">
                    <h5 class="div-valor_titulo"><i class="fa-solid fa-bag-shopping"></i> Resumo do Pedido</h5>
                    <div class="div-valor_info resumo-pedido">
                        <p>Subtotal (2 itens):</p>
                        <p>R$ 2.599,98</p>
                    </div>
                    <div class="div-valor_info resumo-pedido">
                        <p>Total de frete:</p>
                        <p>R$ 9,99</p>
                    </div>
                    <div class="div-valor_info resumo-pedido">
                        <p class="text-success"><b>Total de descontos:</b></p>
                        <p class="text-success"><b>R$ 0,00</b></p>
                    </div>
                    <div class="div-valor_info resumo-pedido">
                        <h4>Total a pagar:</h4>
                        <h4 class="text-success">R$ 2.609,97</h4>
                    </div>                    
                </div>
            </div>
        </main>
    </body>
</html>