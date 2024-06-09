<?php

class Produto {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($nome, $tipo_id, $preco) {
        $sql = "INSERT INTO produtos (nome, tipo_id, preco) VALUES (:nome, :tipo_id, :preco)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['nome' => $nome, 'tipo_id' => $tipo_id, 'preco' => $preco]);
    }

    public function getById($id) {
        $sql = "SELECT p.*, t.imposto_percentual FROM produtos p JOIN tipos_produtos t ON p.tipo_id = t.id WHERE p.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $query = "SELECT p.id, p.nome, tp.nome as tipo, p.preco FROM produtos p JOIN tipos_produtos tp ON p.tipo_id = tp.id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
