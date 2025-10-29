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
    modeloSelect.innerHTML += '<option value="modelo3">Modelo 3</option>';
    modeloSelect.innerHTML += '<option value="modelo4">Modelo 4</option>';
    } else if (categoria === 'praia') {
    modeloSelect.innerHTML += '<option value="praia1">Moda Praia 1</option>';
    modeloSelect.innerHTML += '<option value="praia2">Moda Praia 2</option>';
    modeloSelect.innerHTML += '<option value="praia3">Moda Praia 3</option>';
    modeloSelect.innerHTML += '<option value="praia4">Moda Praia 4</option>';
    } else if (categoria === 'vestido') {
    modeloSelect.innerHTML += '<option value="vestido1">Vestido 1</option>';
    modeloSelect.innerHTML += '<option value="vestido2">Vestido 2</option>';
    modeloSelect.innerHTML += '<option value="vestido3">Vestido 3</option>';
    modeloSelect.innerHTML += '<option value="vestido4">Vestido 4</option>';
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