<?php
session_start();
require 'dbconnect.php';

header('Content-Type: application/json');
$action = isset($_GET['action']) ? $_GET['action'] : null;

    if ($action === 'showIncidents') {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id == null) {
            try {
                if (in_array("view_incidents", $_SESSION['rights'])) {
                    //Rechten check, zodat alleen gebruikers met view_notes rechten de note meekrijgen zodat hij niet gelekt wordt in network tab
                    if (in_array("view_notes", $_SESSION['rights'])) {
                        $stmt = $conn->prepare("SELECT i.*, c.name as category, s.name as status FROM incidents i JOIN categories c ON i.category_id = c.id JOIN statuses s ON i.status_id = s.id ORDER BY priority ASC");
                    } else {
                        $stmt = $conn->prepare("SELECT i.id, i.user_id, i.title, i.description, i.priority, i.media, i.tower, i.floor, i.class_area, create_date, last_updated, c.name as category, s.name as status FROM incidents i JOIN categories c ON i.category_id = c.id JOIN statuses s ON i.status_id = s.id ORDER BY priority ASC");
                    }
                    $stmt->execute();

                    $incidents = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    echo json_encode($incidents);
                } else {
                    if (in_array("view_notes", $_SESSION['rights'])) {
                        $stmt = $conn->prepare("SELECT i.*, c.name as category, s.name as status FROM incidents i JOIN categories c ON i.category_id = c.id JOIN statuses s ON i.status_id = s.id WHERE i.user_id = :userID");
                    } else {
                        $stmt = $conn->prepare("SELECT i.id, i.user_id, i.title, i.description, i.priority, i.media, i.tower, i.floor, i.class_area, create_date, last_updated, c.name as category, s.name as status FROM incidents i JOIN categories c ON i.category_id = c.id JOIN statuses s ON i.status_id = s.id WHERE i.user_id = :userID");
                    }
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
                if (in_array("view_notes", $_SESSION['rights'])) {
                    $stmt = $conn->prepare("SELECT i.*, DATE_FORMAT(i.create_date,'%d-%m-%Y %H:%m') create_date, DATE_FORMAT(i.last_updated,'%d-%m-%Y %H:%m') last_updated, u.first_name name, c.name category, s.name status FROM incidents i JOIN categories c ON i.category_id = c.id JOIN statuses s ON i.status_id = s.id JOIN users u ON u.id = i.user_id WHERE i.id = :id;");
                } else {
                    $stmt = $conn->prepare("SELECT i.id, i.user_id, i.title, i.description, i.priority, i.media, i.tower, i.floor, i.class_area, DATE_FORMAT(i.create_date,'%d-%m-%Y %H:%m') create_date, DATE_FORMAT(i.last_updated,'%d-%m-%Y %H:%m') last_updated, u.first_name name, c.name category, s.name status FROM incidents i JOIN categories c ON i.category_id = c.id JOIN statuses s ON i.status_id = s.id JOIN users u ON u.id = i.user_id WHERE i.id = :id;");
                }
                $stmt->bindParam(':id', $id);
                $stmt->execute();

                $incident = $stmt->fetch(PDO::FETCH_ASSOC);
                echo json_encode(['incident' => $incident, 'rights' => json_encode(array($_SESSION['rights']))]);
            } catch (PDOException $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to fetch incidents: ' . $e->getMessage()]);
            }
        }
    }

if ($action === 'createIncident') {
    $data = json_decode(file_get_contents('php://input'), true);
    try {
        $sql = "INSERT INTO incidents (user_id, priority, category_id, create_date, title, media, description, tower, floor, class_area) 
                VALUES (:user_id, :priority, :category, NOW(), :title, :media, :description, :tower, :floor, :class_area)";
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

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Incident created successfully', 'newIncidentID' => $conn->lastInsertId()]);
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

            $stmt = $conn->prepare("WITH RECURSIVE role_hierarchy AS (SELECT id AS role_id, parent_role_id FROM roles WHERE id = :roleID UNION ALL SELECT r.id AS role_id, r.parent_role_id FROM roles r INNER JOIN role_hierarchy rh ON r.parent_role_id = rh.role_id)
            SELECT DISTINCT rights.name AS right_name FROM role_hierarchy INNER JOIN roles_rights rr ON role_hierarchy.role_id = rr.role_id INNER JOIN rights ON rr.right_id = rights.id ORDER BY rights.name;");

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
    $incidentID = isset($_GET['id']) ? $_GET['id'] : null;
    $loggedInUserID = $_SESSION['userID'];
    try {
        if ($incidentID == null) {
            $stmt = $conn->prepare("SELECT u.first_name name, r.name role, ir.user_id, ir.message FROM incident_replies ir JOIN users u ON ir.user_id = u.id JOIN roles r ON u.role_id = r.id ORDER BY ir.create_date;");
            $stmt->execute();

            $replies = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($replies);
        } else {
            $stmt = $conn->prepare("WITH RECURSIVE role_hierarchy AS (SELECT r.id AS role_id, r.parent_role_id FROM roles r JOIN roles_rights rr ON r.id = rr.role_id JOIN rights rt ON rr.right_id = rt.id WHERE rt.name = 'send_staff_messages' UNION ALL
            SELECT r.id AS role_id, r.parent_role_id FROM roles r INNER JOIN role_hierarchy rh ON rh.parent_role_id = r.id)
            SELECT DISTINCT u.id AS user_id FROM users u JOIN role_hierarchy rh ON u.role_id = rh.role_id ORDER BY u.id;");
            $stmt->execute();

            $staffMessagesUserIDs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = $conn->prepare("SELECT u.first_name name, r.name role, ir.user_id, ir.message, ir.create_date time FROM incident_replies ir JOIN users u ON ir.user_id = u.id JOIN roles r ON u.role_id = r.id WHERE ir.incident_id = :incident_id ORDER BY ir.create_date;");
            $stmt->bindParam(':incident_id', $incidentID, PDO::PARAM_INT);
            $stmt->execute();

            $replies = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode(['message' => $replies, 'loggedInUserID' => $_SESSION['userID'], 'staffMessagesUserIDs' => $staffMessagesUserIDs]);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to fetch incidents: ' . $e->getMessage()]);
    }
}

if ($action === 'sendChatMessage') {
    $data = json_decode(file_get_contents('php://input'), true);

    try {
        $sql = "INSERT INTO incident_replies (incident_id, user_id, message, media)
                VALUES (:incident_id, :user_id, :message, 'test')";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':incident_id', $data['incidentID'], PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_SESSION['userID'], PDO::PARAM_INT);
        $stmt->bindParam(':message', $data['message'], PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Message successfully sent']);
        } else {
            echo json_encode(['error' => 'Failed to send message']);
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

if ($action === 'editIncident') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (in_array("manage_incidents", $_SESSION['rights'])) {
        try {
            $sql = "UPDATE incidents SET title = :title, description = :description, note = :note, last_updated = NOW(), category_id = (SELECT category_id FROM categories WHERE name = :category), priority = :priority, status_id = (SELECT status_id FROM statuses WHERE name = :status), tower = :tower, floor = :floor, class_area = :class_area WHERE incidents.id = :id ;";
            $stmt = $conn->prepare($sql);
            
            $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
            $stmt->bindParam(':priority', $data['priority'], PDO::PARAM_INT);
            $stmt->bindParam(':note', $data['note'], PDO::PARAM_STR);
            $stmt->bindParam(':status', $data['status'], PDO::PARAM_STR);
            $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);
            $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':tower', $data['tower'], PDO::PARAM_STR);
            $stmt->bindParam(':floor', $data['floor'], PDO::PARAM_INT);
            $stmt->bindParam(':class_area', $data['class_area'], PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Incident created successfully', 'newIncidentID' => $conn->lastInsertId()]);
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
    } else {
        echo json_encode("Geen machtiging!");
    }
}
?>