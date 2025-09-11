<?php 
namespace Models;

use Models\Connection\Database;

class main 
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getConnection()
    {
        return $this->db->conn;
    }
}