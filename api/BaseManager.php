<?php

abstract class BaseManager 
{
    protected $pdo;
    protected $jsonFile;
    protected $table;

    public function __construct($host, $dbname, $username, $password, $jsonFile) 
    {
        try 
        {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->jsonFile = $jsonFile;
        } 
        catch (PDOException $e) 
        {
            echo "Database connection failed: " . $e->getMessage();
            exit;
        }
    }

    abstract protected function setTable();

    public function delete($id)
    {
        try 
        {
            $this->setTable();
            $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $this->updateJsonFile();
            return ['status' => 'success', 'message' => ucfirst($this->table) . ' deleted successfully.'];
        } 
        catch (PDOException $e) 
        {
            return ['status' => 'error', 'message' => 'Failed to delete ' . $this->table . ': ' . $e->getMessage()];
        }
    }

    protected function updateJsonFile()
    {
        try 
        {
            $this->setTable();
            $stmt = $this->pdo->prepare("SELECT * FROM $this->table");
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            file_put_contents($this->jsonFile, json_encode($data, JSON_PRETTY_PRINT));
        } 
        catch (PDOException $e) 
        {
            echo "Failed to update JSON file: " . $e->getMessage();
            exit;
        }
    }
}

?>
