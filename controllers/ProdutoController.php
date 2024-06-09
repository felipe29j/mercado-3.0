<?php

require_once '../models/Database.php';
require_once '../models/Produto.php';

class ProdutoController {
    private $produtoModel;
    private $database;

    public function __construct() {
        $this->database = new Database();
        $this->produtoModel = new Produto($this->database->connect());
    }

    public function cadastrarProduto($nome, $tipo_id, $preco) {
        $this->produtoModel->create($nome, $tipo_id, $preco);
        session_start();
        $_SESSION['success_message'] = 'Produto cadastrado com sucesso!';
        header('Location: ../views/cadastrar_produto.php');
        exit();
    }

    public function listarProdutos() {
        return $this->produtoModel->getAll();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['nome']) && isset($_POST['tipo_id']) && isset($_POST['preco'])) {
        $nome_produto = $_POST['nome'];
        $tipo_id = $_POST['tipo_id'];
        $preco_produto = $_POST['preco'];

        $controller = new ProdutoController();
        $controller->cadastrarProduto($nome_produto, $tipo_id, $preco_produto);
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}

?>
