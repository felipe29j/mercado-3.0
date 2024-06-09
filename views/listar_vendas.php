<?php
require_once '../controllers/VendaController.php';

$vendaController = new VendaController();
$produtos = $vendaController->getAllVendas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/listar_vendas.css">
    <title>Mercado</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Listar Vendas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade Vendida</th>
                    <th>Valor Total</th>
                    <th>Valor do Imposto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo $produto['produto_nome']; ?></td> <!-- Nome do produto -->
                    <td><?php echo $produto['quantidade_total']; ?></td> <!-- Quantidade Vendida -->
                    <td>R$ <?php echo number_format($produto['valor_total'], 2, ',', '.'); ?></td> <!-- Valor Total -->
                    <td>R$ <?php echo number_format($produto['valor_imposto'], 2, ',', '.'); ?></td> <!-- Valor do Imposto -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
