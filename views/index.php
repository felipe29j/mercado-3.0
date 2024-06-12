<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Mercado</title>
    <script src="../js/index.js"></script>
</head>
<body>
<?php include 'navbar.php'; ?>

    <div class="container">
        <div class="highlight-box">
            <h1>Bem-vindo ao Sistema de Gestão de Mercado</h1>
            <p>Este sistema oferece uma maneira fácil e eficiente de gerenciar as operações do seu mercado.</p>
        </div>
        <div class="features">
            <div class="feature">
                <i class="fas fa-shopping-cart"></i>
                <h2>Registrar Venda</h2>
                <p>Registre as vendas dos seus produtos de forma rápida e simples.</p>
            </div>
            <div class="feature">
                <i class="fas fa-box"></i>
                <h2>Cadastro de Produto</h2>
                <p>Adicione novos produtos ao seu catálogo com facilidade.</p>
            </div>
            <div class="feature">
                <i class="fas fa-list"></i>
                <h2>Listar Produtos</h2>
                <p>Visualize todos os produtos cadastrados no sistema.</p>
            </div>
        </div>
        <div class="cta">
            <a href="cadastrar_tipo_produto.php" class="button">Comece Agora</a>
        </div>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="modal-close" onclick="closeModal()">&times;</span>
                <h2>Seja bem-vindo!</h2>
                <p>O Sistema de Gestão de Mercado é uma ferramenta poderosa para gerenciar suas vendas, produtos e muito mais. Utilize o menu acima para navegar pelas funcionalidades.</p>
                <br>
                <button class="close-button" onclick="closeModal()">Fechar</button>
            </div>
        </div>
    </div>
</body>
</html>
