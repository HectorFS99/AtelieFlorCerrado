<header class="cabecalho">
    <div>
        <h1>Painel Administrativo</h1>
        <span id="data-atual"></span>
    </div>
    <div class="dropdown">
        <button class="botao btn-usuario" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="mx-2" id="info_usr_nome"><?php echo $usuario['nome_completo']; ?></span>
            <img id="info_usr_foto" src="<?php echo $usuario['caminho_img_perfil']; ?>">
        </button>
        <ul class="dropdown-menu">
            <li>
                <div class="info-usuario">
                    <span id="info_usr_email"><?php echo $usuario['email']; ?></span>
                    <span id="info_usr_celular" ><?php echo $usuario['telefone_celular']; ?></span>
                </div>
                <button type="button" onclick="deslogar('usuarioLogado')" class="dropdown-item">
                    <i class="fa-solid fa-person-walking-arrow-right"></i>Sair
                </button>
            </li>
        </ul>
    </div>
</header>
<hr class="divisor">
<script>
    document.addEventListener('DOMContentLoaded', function() {        
        const usuarioLogado = JSON.parse(sessionStorage.getItem('usuarioLogado'));
        if (!usuarioLogado) {
            notificar(true, 'Acesso negado', 'Você será redirecionado para a tela de login.', 'error', 'adm_login.php')
            return;
        }

        document.getElementById('info_usr_nome').textContent = usuarioLogado.nomeCompleto;
        document.getElementById('info_usr_foto').src = usuarioLogado.caminhoImgPerfil;
        document.getElementById('info_usr_email').textContent = usuarioLogado.email;
        document.getElementById('info_usr_celular').textContent = usuarioLogado.telefoneCelular;

        function formatarData(data) {
            const opcoesData = { day: 'numeric', month: 'long', year: 'numeric' };
            const dataFormatada = data.toLocaleDateString('pt-BR', opcoesData);
            
            const horas = String(data.getHours()).padStart(2, '0');
            const minutos = String(data.getMinutes()).padStart(2, '0');
            
            return `${dataFormatada} - ${horas}:${minutos}`;
        }

        const dataAtual = new Date();
        const elementoData = document.getElementById('data-atual');

        if (elementoData) {
            elementoData.textContent = formatarData(dataAtual);
        }
    });
</script>