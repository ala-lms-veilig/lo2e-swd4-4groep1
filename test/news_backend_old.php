<?php

class BaseManager 
{

    protected $pdo;
    protected $jsonFile;
    protected $table;

    public function __construct($host, $dbname, $username, $password, $jsonFile, $table) 
    {
        try 
        {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->jsonFile = $jsonFile;
            $this->table = $table;
        } 
        catch (PDOException $e) 
        {
            echo "Database connection failed: " . $e->getMessage();
            exit;
        }
    }

    public function create($data)
    {
        //
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)"; 
        //
        try 
        {
            $stmt = $this->pdo->prepare($sql);
            foreach ($data as $key => $value) 
            {
                $stmt->bindParam(":$key", $data[$key]);
            }
            $stmt->execute();

            // Update the JSON file
            $this->updateJsonFile();
            return ['status' => 'success', 'message' => ucfirst($this->table) . ' created successfully.'];
        } 
        catch (PDOException $e) 
        {
            return ['status' => 'error', 'message' => 'Failed to create ' . $this->table . ': ' . $e->getMessage()];
        }
    }

    public function update($id, $data)
    {
        //
        $fields = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) 
        {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $sql = "UPDATE $this->table SET " . implode(", ", $fields) . " WHERE id = :id";
        //
        try 
        {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);

            // Update the JSON file
            $this->updateJsonFile();
            return ['status' => 'success', 'message' => ucfirst($this->table) . ' updated successfully.'];
        } 
        catch (PDOException $e) 
        {
            return ['status' => 'error', 'message' => 'Failed to update ' . $this->table . ': ' . $e->getMessage()];
        }
    }

    public function delete($id)
    {
        try 
        {
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
