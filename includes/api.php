<?php
session_start();
require 'dbconnect.php';

header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($action === 'showIncidents') {
    if ($id == null) {
        try {
            $stmt = $conn->prepare("SELECT i.*, c.name as category, s.name as status FROM incidents i JOIN categories c ON i.category_id = c.category_id JOIN statuses s ON i.status_id = s.status_id ORDER BY priority ASC");
            $stmt->execute();

            $incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (in_array("view_incidents", $_SESSION['rights'])) {
                echo json_encode($incidents);
            } else {
                $stmt = $conn->prepare("SELECT i.* , c.name, s.name FROM incidents i JOIN categories c ON i.category_id = c.category_id JOIN statuses s ON i.status_id = s.status_id WHERE user_id = :userID");
                $stmt->bindParam(':userID', $_SESSION['userID']);
                $stmt->execute();

                $incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo json_encode($incidents);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch incidents: ' . $e->getMessage()]);
        }
    } else {
        try {
            $stmt = $conn->prepare("SELECT i.*, c.name as category, s.name as status FROM incidents i JOIN categories c ON i.category_id = c.category_id JOIN statuses s ON i.status_id = s.status_id WHERE i.id = :id ORDER BY priority ASC");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $incident = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($incident);
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to fetch incidents: ' . $e->getMessage()]);
        }
    }
}

if ($action === 'createIncident') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $sql = "INSERT INTO incidents (user_id, priority, category, title, media, description, tower, floor, class_area, status) 
                VALUES (:user_id, :priority, :category, :title, :media, :description, :tower, :floor, :class_area, :status)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':user_id', $_SESSION['userID'], PDO::PARAM_INT);
        $stmt->bindParam(':priority', $data['priority'], PDO::PARAM_INT);
        $stmt->bindParam(':category', $data['category'], PDO::PARAM_INT);
        $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindParam(':media', $data['media'], PDO::PARAM_STR);
        $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
        $stmt->bindParam(':tower', $data['tower'], PDO::PARAM_STR);
        $stmt->bindParam(':floor', $data['floor'], PDO::PARAM_INT);
        $stmt->bindParam(':class_area', $data['class_area'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $data['status'], PDO::PARAM_INT);

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
            $stmt->bindParam(':roleID', $user['role_id']);
            $stmt->execute();
            $_SESSION['rights'] = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            $stmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = :userID");
            $stmt->bindParam(':userID', $user['userID']);
            $stmt->execute();

            header('Location: ./../account.php');

            echo json_encode(['success' => true, 'message' => 'Login successful']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    }
}

if ($action === 'deleteIncident') {
    try {

        $incidentID = $_GET['incidentID'];

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

if ($action === 'getChatMessages') {
    try {
        $stmt = $conn->prepare("SELECT ir*, c.name as category, s.name as status FROM incident_replies ir JOIN categories c ON i.category_id = c.category_id JOIN statuses s ON i.status_id = s.status_id WHERE i.id = :id ORDER BY priority ASC");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $incident = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($incident);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch incidents: ' . $e->getMessage()]);
    }
}
}
?>