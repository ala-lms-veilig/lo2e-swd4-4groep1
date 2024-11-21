<?php
session_start();
require 'dbconnect.php';

header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : null;
if ($action === 'showIncidents') {
    try {
        $sql = "SELECT * FROM incidents";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($incidents);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch incidents: ' . $e->getMessage()]);
    }
}

if ($action === 'createIncident') {
    
    // Check if data is valid and present
    if (isset($inputData['priority'], $inputData['category'], $inputData['title'], $inputData['description'])) {
        try {
            $sql = "INSERT INTO incidents (priority, category, title, media, description) VALUES (:priority, :category, :title, :media, :description)";
            $stmt = $conn->prepare($sql);

            // Bind the values to the SQL statement
            $stmt->bindParam(':id', $SESSION['userID']);
            $stmt->bindParam(':priority', $inputData['priority']);
            $stmt->bindParam(':category', $inputData['category']);
            $stmt->bindParam(':title', $inputData['title']);
            $stmt->bindParam(':media', $inputData['media']);
            $stmt->bindParam(':description', $inputData['description']);
            $stmt->bindParam(':status', 1);
            $stmt->bindParam(':tower', 'A');
            $stmt->bindParam(':level', 1);
            $stmt->bindParam(':class_area', 'test');

            // Execute the query to insert the data
            $stmt->execute();

            // Return success response
            echo json_encode(['status' => 'success', 'message' => 'Incident created successfully']);
        } catch (PDOException $e) {
            // Handle any database errors
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        // Return error if data is missing
        echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    }
}

if ($action === "login") {
    // Read JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    // Sanitize user input
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Query the database for the user
        $stmt = $conn->prepare("SELECT id, e_mail, password FROM users WHERE e_mail = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            // Password is correct; set session or return success
            $_SESSION['userID'] = $user['id'];
            header('Location: ./../account.php');

            echo json_encode(['success' => true, 'message' => 'Login successful']);
        }
    } catch (Exception $e) {
        // Handle errors
        echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    }
}

?>