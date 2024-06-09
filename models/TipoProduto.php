<?php

class TipoProduto {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($nome, $imposto_percentual) {
        $sql = "INSERT INTO tipos_produtos (nome, imposto_percentual) VALUES (:nome, :imposto_percentual)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['nome' => $nome, 'imposto_percentual' => $imposto_percentual]);
    }

    public function getAll() {
        $query = 'SELECT id, nome FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
