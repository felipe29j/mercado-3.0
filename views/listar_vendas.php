<?php
require_once '../models/Database.php'; 
$database = new Database();
$pdo = $database->connect();

$stmt = $pdo->query('SELECT p.nome AS produto_nome, SUM(v.quantidade) AS quantidade_total, 
    SUM(v.valor_total) AS valor_total, 
    SUM(v.valor_imposto) AS valor_imposto 
    FROM vendas v JOIN produtos p ON v.produto_id = p.id 
    GROUP BY v.produto_id, p.nome
    ORDER BY quantidade_total DESC');
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
                <?php while ($row = $stmt->fetch()): ?>
                <tr>
                    <td><?php echo $row['produto_nome']; ?></td>
                    <td><?php echo $row['quantidade_total']; ?></td>
                    <td>R$ <?php echo number_format($row['valor_total'], 2, ',', '.'); ?></td>
                    <td>R$ <?php echo number_format($row['valor_imposto'], 2, ',', '.'); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
