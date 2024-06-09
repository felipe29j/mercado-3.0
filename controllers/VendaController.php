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

    public function getAllVendas() {
        $stmt = $this->db->query('SELECT p.nome AS produto_nome, SUM(v.quantidade) AS quantidade_total, 
                SUM(v.valor_total) AS valor_total, 
                SUM(v.valor_imposto) AS valor_imposto 
                FROM vendas v JOIN produtos p ON v.produto_id = p.id 
                GROUP BY v.produto_id, p.nome
                ORDER BY quantidade_total DESC');
                
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProdutos() {
        $stmt = $this->db->query('SELECT p.id, p.nome, p.preco, t.imposto_percentual FROM produtos p JOIN tipos_produtos t ON p.tipo_id = t.id');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produtos_quantidades'])) {
    $produtos_quantidades = $_POST['produtos_quantidades'];

    $controller = new VendaController();
    $controller->efetuarVenda($produtos_quantidades);
}
?>
