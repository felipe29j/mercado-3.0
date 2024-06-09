<?php require_once '../models/Database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/cadastro_produto.css">
    <title>Mercado</title>
    <script>
        window.onload = function() {
            <?php
            session_start();
            if (isset($_SESSION['success_message'])) {
                echo "alert('{$_SESSION['success_message']}');";
                unset($_SESSION['success_message']);
            } elseif (isset($_SESSION['error_message'])) {
                echo "alert('{$_SESSION['error_message']}');";
                unset($_SESSION['error_message']);
            }
            ?>
        }
    </script>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Cadastro de Produto</h2>
        <form action="../controllers/ProdutoController.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="tipo_id">Tipo de Produto</label>
                <select id="tipo_id" name="tipo_id" required>
                    <option value="">Selecione</option>
                    <?php
                    $database = new Database();
                    $pdo = $database->connect();
                    $stmt = $pdo->query('SELECT id, nome FROM tipos_produtos');
                    while ($row = $stmt->fetch()) {
                        echo "<option value=\"{$row['id']}\">{$row['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" id="preco" name="preco" step="0.01" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
