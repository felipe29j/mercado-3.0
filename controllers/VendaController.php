<?php

require_once '../models/Database.php';
require_once '../models/Venda.php';
require_once '../models/Produto.php';

class VendaController {
    private $db;
    private $venda;
    private $produto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
        $this->venda = new Venda($this->db);
        $this->produto = new Produto($this->db);
    }

    public function efetuarVenda($produtos_quantidades) {
        $vendaRegistrada = false;

        foreach ($produtos_quantidades as $produto_id => $quantidade) {
            $produto = $this->produto->getById($produto_id);
            if ($produto) {
                $preco_total = $produto['preco'] * $quantidade;
                $imposto_total = ($produto['imposto_percentual'] / 100) * $preco_total;
                $this->venda->create($produto_id, $quantidade, $preco_total, $imposto_total);
                $vendaRegistrada = true;
            } else {
                echo "Produto com ID $produto_id não encontrado.";
            }
        }

        echo '<script>';
        if ($vendaRegistrada) {
            echo 'alert("Venda registrada com sucesso!");';
        } else {
            echo 'alert("Falha ao registrar a venda!");';
        }
        echo 'window.location.href = "../views/efetuar_venda.php";';
        echo '</script>';
        exit();
    }

}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produtos_quantidades'])) {
    $produtos_quantidades = $_POST['produtos_quantidades'];

    $controller = new VendaController();
    $controller->efetuarVenda($produtos_quantidades);
}
?>
