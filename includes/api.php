<?php
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
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid action']);
}

$conn = null;
?>