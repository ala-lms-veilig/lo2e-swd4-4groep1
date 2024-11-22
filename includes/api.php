<?php
session_start();
require 'dbconnect.php';

header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : null;

if ($action === 'showIncidents') {
    try {
        $stmt = $conn->prepare("SELECT * FROM incidents");
        $stmt->execute();

        $incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (in_array("view_incidents", $_SESSION['rights'])) {
            echo json_encode($incidents);
        } else {
            $stmt = $conn->prepare("SELECT * FROM incidents WHERE user_id = :userID");
            $stmt->bindParam(':userID', $_SESSION['userID']);
            $stmt->execute();

            $incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($incidents);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch incidents: ' . $e->getMessage()]);
    }
}

if ($action === 'createIncident') {
    echo $_POST['new-incident-priority-input'];
    try {
        $priority = $_POST['new-incident-priority-input'] ?? null;
        $category = $_POST['new-incident-category-input'] ?? null;
        $title = $_POST['new-incident-title-input'] ?? null;
        $media = $_POST['new-incident-media-input'] ?? null;
        $description = $_POST['new-incident-description-input'] ?? null;
        $tower = $_POST['new-incident-tower-input'] ?? null;
        $floor = $_POST['new-incident-floor-input'] ?? null;
        $classArea = $_POST['new-incident-class-input'] ?? null;
        $status = $_POST['new-incident-status-input'] ?? 1;

        $sql = "INSERT INTO incidents (priority, category, title, media, description, tower, floor, class_area, status) 
                VALUES (:priority, :category, :title, :media, :description, :tower, :floor, :class_area, :status)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':priority', $priority, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':media', $media, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':tower', $tower, PDO::PARAM_STR);
        $stmt->bindParam(':floor', $floor, PDO::PARAM_INT);
        $stmt->bindParam(':class_area', $classArea, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Incident created successfully']);
        } else {
            echo json_encode(['error' => 'Failed to create incident']);
            http_response_code(500);
        }

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
        http_response_code(500);
    } catch (Exception $e) {
        echo json_encode(['error' => 'An unexpected error occurred: ' . $e->getMessage()]);
        http_response_code(500);
    }
}

if ($action === "login") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id, first_name, e_mail, password, role_id FROM users WHERE e_mail = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $password === $user['password']) {
            $_SESSION['userID'] = $user['id'];
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['roleID'] = $user['role_id'];

            $stmt = $conn->prepare("SELECT r.name FROM roles_rights rr JOIN rights r ON rr.right_id = r.id WHERE rr.role_id = :roleID");
            $stmt->bindParam(':roleID', $_SESSION['roleID']);
            $stmt->execute();
            $_SESSION['rights'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            header('Location: ./../account.php');

            echo json_encode(['success' => true, 'message' => 'Login successful']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    }
}

if ($action === 'deleteIncident') {
    try {

        $incidentID = intval($_GET['incidentID']);

        $stmt = $conn->prepare("DELETE FROM incidents WHERE id = :id");
        $stmt->bindParam(':id', $incidentID, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => "Incident $incidentID deleted."]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => "Incident $incidentID not found."]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to delete incident: ' . $e->getMessage()]);
    }
}

?>