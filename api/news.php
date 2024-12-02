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


///////////////////////////////////////////////////////////////////////////////////////


// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the ID from the query string
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
            $jsonFile = 'path/to/your/news.json';
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
?>
