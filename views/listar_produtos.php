<?php
require_once '../models/Database.php'; // Importando a classe Database

// Criando uma instância da classe Database para conectar ao banco de dados
$database = new Database();
$pdo = $database->connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/listar_produtos.css">
    <title>Mercado</title>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Listar Produtos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta SQL para obter os produtos e seus tipos
                $stmt = $pdo->query('SELECT p.id, p.nome, t.nome AS tipo, p.preco FROM produtos p JOIN tipos_produtos t ON p.tipo_id = t.id');
                while ($row = $stmt->fetch()) {
                    $preco = str_replace('.', ',', $row['preco']);
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['tipo']}</td>
                            <td>R$ {$preco}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
