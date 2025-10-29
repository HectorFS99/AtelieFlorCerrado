$(document).ready(function () {
    $(".franela").draggable();
});

    const categoriaSelect = document.getElementById('categoriaSelect');
    const modeloSelect = document.getElementById('modeloSelect');
    const opcaoCategoria = document.getElementById('opcaoCategoria');

    function mostrarOpcoes() {
      const categoria = categoriaSelect.value;
      modeloSelect.innerHTML = '<option value="">-- Escolha um modelo --</option>';

      if (categoria === 'modelo') {
        modeloSelect.innerHTML += '<option value="modelo1">Modelo 1</option>';
        modeloSelect.innerHTML += '<option value="modelo2">Modelo 2</option>';
      } else if (categoria === 'praia') {
        modeloSelect.innerHTML += '<option value="praia1">Moda Praia 1</option>';
        modeloSelect.innerHTML += '<option value="praia2">Moda Praia 2</option>';
      } else if (categoria === 'vestido') {
        modeloSelect.innerHTML += '<option value="vestido1">Vestido 1</option>';
        modeloSelect.innerHTML += '<option value="vestido2">Vestido 2</option>';
      }

      opcaoCategoria.style.display = categoria ? 'block' : 'none';
      esconderTodosModelos();
    }

    function esconderTodosModelos() {
      document.querySelectorAll('.modelo').forEach(m => m.style.display = 'none');
    }

    function mostrarModelo() {
      esconderTodosModelos();
      const modeloEscolhido = modeloSelect.value;
      if (modeloEscolhido) {
        document.getElementById(modeloEscolhido).style.display = 'block';
      }
    }