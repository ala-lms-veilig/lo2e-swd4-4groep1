<?php
// Database connection (modify with your database details)
$host = 'localhost';  // Database host
$dbname = 'your_database';  // Your database name
$username = 'your_username';  // Your database username
$password = 'your_password';  // Your database password

// Create a connection to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

/////////////////////////////////////////////////////////////

// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            // Step 1: Delete the record from the database
            $stmt = $pdo->prepare("DELETE FROM news WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Step 2: Update the JSON file after deletion
            // Fetch the updated records from the database
            $stmt = $pdo->prepare("SELECT * FROM news");
            $stmt->execute();
            $newsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Write the updated data to a JSON file
            $jsonFile = 'path/to/your/news.json';  // Modify this path as needed
            file_put_contents($jsonFile, json_encode($newsData, JSON_PRETTY_PRINT));

            // Respond with success
            $response = [
                'status' => 'success',
                'message' => "News with ID $id deleted successfully."
            ];

        } catch (PDOException $e) {
            // If there was an error deleting or updating the database
            $response = [
                'status' => 'error',
                'message' => 'Failed to delete the record: ' . $e->getMessage()
            ];
        }

        // Send the JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        // If no ID was provided in the query string
        $response = [
            'status' => 'error',
            'message' => 'ID is required for deletion.'
        ];

        // Send the error response
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

////////////////////////////////////////////////////////////////



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
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
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
        $fields = [];
        $params = [':id' => $id];

        foreach ($data as $key => $value) 
        {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }

        $sql = "UPDATE $this->table SET " . implode(", ", $fields) . " WHERE id = :id";
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
