<?php
require_once '../controllers/VendaController.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/registrar_venda.css">
    <title>Mercado</title>
    <script src="../js/registrar_venda.js"></script>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Efetuar Venda</h2>
        <form action="../controllers/VendaController.php" method="POST" onsubmit="return validarFormulario();">
            <div class="form-group">
                <label for="produto_id">Produto</label>
                <select id="produto_id" name="produto_id">
                    <option value="">Selecione</option>
                    <?php
                    $vendaController = new VendaController();
                    $produtos = $vendaController->getAllProdutos();
                    foreach ($produtos as $produto) {
                        echo "<option value=\"{$produto['id']}\" data-preco=\"{$produto['preco']}\" data-imposto=\"{$produto['imposto_percentual']}\">{$produto['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="number" id="quantidade" name="quantidade">
            </div>
            <button type="button" onclick="adicionarProduto()">Adicionar Produto</button>
            <br><br>
            <div id="produtos-selecionados-section">
                <h2>Produtos Selecionados</h2>
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>&nbsp;&nbsp;&nbsp;</th>
                        <th>Produto</th>
                        <th>&nbsp;&nbsp;&nbsp;</th>
                        <th>Quantidade</th>
                        <th>&nbsp;&nbsp;&nbsp;</th>
                        <th>Valor Total</th>
                        <th>&nbsp;&nbsp;&nbsp;</th>
                        <th>Valor do Imposto</th>
                    </tr>
                    </thead>
                    <tbody id="produtos-selecionados">
                    </tbody>
                    <br>
                    <br>
                    <tfoot>
                    <tr>
                        <td colspan="9" class="totais">
                            <div class="totais-item">
                                <span class="totais-label">Total da Compra:</span>
                                <span id="total-compra">R$ 0.00</span>
                            </div>
                            <div class="totais-item">
                                <span class="totais-label">Total dos Impostos:</span>
                                <span id="total-impostos">R$ 0.00</span>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <br>
            <div id="produtos-quantidades"></div>
            <button id="registrar-venda-button" type="submit" name="submit">Registrar Venda</button>
        </form>
    </div>
</body>
</html>
