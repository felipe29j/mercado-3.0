<?php

class Venda {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($produto_id, $quantidade, $valor_total, $valor_imposto) {
        $sql = "INSERT INTO vendas (produto_id, quantidade, valor_total, valor_imposto) VALUES (:produto_id, :quantidade, :valor_total, :valor_imposto)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'produto_id' => $produto_id,
            'quantidade' => $quantidade,
            'valor_total' => $valor_total,
            'valor_imposto' => $valor_imposto
        ]);
    }
}
?>
