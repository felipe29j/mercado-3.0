
function adicionarProduto() {
    var produtoId = document.getElementById('produto_id').value;
    var produtoNome = document.getElementById('produto_id').options[document.getElementById('produto_id').selectedIndex].text;
    var preco = parseFloat(document.getElementById('produto_id').options[document.getElementById('produto_id').selectedIndex].getAttribute('data-preco'));
    var imposto = parseFloat(document.getElementById('produto_id').options[document.getElementById('produto_id').selectedIndex].getAttribute('data-imposto'));
    var quantidade = parseInt(document.getElementById('quantidade').value);

    if (!produtoId || !quantidade || quantidade < 1 || isNaN(preco) || isNaN(imposto)) {
        alert("Por favor, selecione um produto válido e insira uma quantidade válida.");
        return;
    }

    var produto = {
        id: produtoId,
        nome: produtoNome,
        preco: preco,
        imposto: imposto,
        quantidade: quantidade
    };

    adicionarProdutoLista(produto);

    document.getElementById('produtos-selecionados-section').style.display = 'block';
    document.getElementById('registrar-venda-button').style.display = 'block';
}

var produtosSelecionados = [];
function adicionarProdutoLista(produto) {
    var tabela = document.getElementById('produtos-selecionados');
    var rows = tabela.getElementsByTagName('tr');
    var encontrado = false;

    for (var i = 0; i < rows.length; i++) {
        var cols = rows[i].getElementsByTagName('td');
        if (cols[0].innerText === produto.id) {

            var novaQuantidade = parseFloat(cols[4].innerText) + produto.quantidade;
            var novoValorTotal = produto.preco * novaQuantidade;
            var novoValorImposto = (novoValorTotal * produto.imposto) / 100;

            cols[4].innerText = novaQuantidade;
            cols[6].innerText = "R$ " + novoValorTotal.toFixed(2).replace('.', ',');
            cols[8].innerText = "R$ " + novoValorImposto.toFixed(2).replace('.', ',');

            var input = document.querySelector(`input[name="produtos_quantidades[${produto.id}]"]`);
            input.value = novaQuantidade;

            encontrado = true;
            break;
        }
    }

    if (!encontrado) {
        var valorTotal = produto.preco * produto.quantidade;
        var valorImposto = (valorTotal * produto.imposto) / 100;

        var produtoSelecionado = `
        <tr>
            <td>${produto.id}</td>
            <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
            <td>${produto.nome}</td>
            <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
            <td>${produto.quantidade}</td>
            <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
            <td>R$ ${valorTotal.toFixed(2).replace('.', ',')}</td>
            <td>&nbsp;&nbsp;&nbsp;</td> <!-- Adicionando espaços entre as células -->
            <td>R$ ${valorImposto.toFixed(2).replace('.', ',')}</td>
        </tr>
    `;


        tabela.innerHTML += produtoSelecionado;

        var inputProdutos = document.getElementById('produtos-quantidades');
        inputProdutos.innerHTML += `<input type="hidden" name="produtos_quantidades[${produto.id}]" value="${produto.quantidade}">`;
        
    }

    atualizarTotalCompra();
    atualizarTotalImpostos();

    document.getElementById('produto_id').value = '';
    document.getElementById('quantidade').value = '';
}

 

function atualizarTotalCompra() {
    var totalCompra = 0;
    var linhasProdutos = document.getElementById('produtos-selecionados').getElementsByTagName('tr');
    for (var i = 0; i < linhasProdutos.length; i++) {

        var valorTotalTexto = linhasProdutos[i].getElementsByTagName('td')[6].textContent.trim();
        var valorTotalNumerico = parseFloat(valorTotalTexto.replace('R$ ', '').replace(',', '.')); // Removendo o 'R$ ' e substituindo ',' por '.' para garantir a correta conversão para float

        if (!isNaN(valorTotalNumerico)) {
            totalCompra += valorTotalNumerico;
        }
    }
    
    document.getElementById('total-compra').textContent = 'R$ ' + totalCompra.toFixed(2).replace('.', ',');
}


function atualizarTotalImpostos() {
    var totalImpostos = 0;
    var linhasProdutos = document.getElementById('produtos-selecionados').getElementsByTagName('tr');
    for (var i = 0; i < linhasProdutos.length; i++) {
        var valorImpostoTexto = linhasProdutos[i].getElementsByTagName('td')[8].textContent;
        totalImpostos += parseFloat(valorImpostoTexto.replace('R$ ', '').replace(',', '.'));
    }
    document.getElementById('total-impostos').textContent = 'R$ ' + totalImpostos.toFixed(2).replace('.', ',');
}

function validarFormulario() {
    var produtosSelecionados = document.getElementById('produtos-selecionados').innerHTML.trim();
    if (!produtosSelecionados) {
        alert("Por favor, adicione pelo menos um produto antes de registrar a venda.");
        return false;
    }
    return true;
}
