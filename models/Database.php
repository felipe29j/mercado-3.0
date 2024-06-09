<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'mercado';
    private $username = 'seu_username';
    private $password = 'seu_password';
    private $port = '5432'; // Altere para a porta correta, se necessário porta padrão: 5432 afim de testes fiz na porta 8080
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
