<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'mercado';
    private $username = 'postgres';
    private $password = 'Fe@290196';
    private $port = '8080'; // Adicione a porta aqui
    private $conn;

    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Conexão falhou: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
