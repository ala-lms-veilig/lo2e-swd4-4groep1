<?php
namespace models\connection;

use Exception;
use mysqli;

/**
 * class Database
 * maakt verbinding met sql server
 */
class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "Welkom01";
    private $dbname = "LMS_Veiligheid";
    public $conn;

    /**
     * constructor
     * maakt new verbinding aan
     * @throws Exception
     */
    public function __construct() {
        // Maak verbinding
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Controleer verbinding
        if ($this->conn->connect_error) {
            die("Verbinding mislukt: " . $this->conn->connect_error);
        }
    }

    public function __destruct() {
        // Sluit de verbinding
        $this->conn->close();
    }
}
?>