<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cadastro_tipo_produto.css">
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
        <h2>Cadastro de Tipo de Produto</h2>
        <form action="../controllers/TipoProdutoController.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Tipo de Produto</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="imposto_percentual">Percentual de Imposto</label>
                <div class="input-group">
                    <input type="number" id="imposto_percentual" name="imposto_percentual" step="0.01" required>
                    <span>%</span>
                </div>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
