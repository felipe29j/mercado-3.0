<?php
require_once '../models/Database.php';
require_once '../models/TipoProduto.php';

class TipoProdutoController {
    private $tipoProdutoModel;
    private $database;

    public function __construct() {
        $this->database = new Database();
        $this->tipoProdutoModel = new TipoProduto($this->database->connect());
    }

    public function cadastrarTipoProduto($nome, $imposto_percentual) {
        $this->tipoProdutoModel->create($nome, $imposto_percentual);
        session_start();
        $_SESSION['success_message'] = 'Tipo de produto cadastrado com sucesso!';
        header('Location: ../views/cadastrar_tipo_produto.php');
        exit();
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['nome']) && isset($_POST['imposto_percentual'])) {
        $nome_tipo = $_POST['nome'];
        $imposto_percentual = $_POST['imposto_percentual'];

        $controller = new TipoProdutoController();
        $controller->cadastrarTipoProduto($nome_tipo, $imposto_percentual);
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}
?>
