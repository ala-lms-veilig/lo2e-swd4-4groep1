<?php

require_once "../api/NewsManager.php";


$host = 'localhost';
$dbname = 'LMS_Veiligheid_Database_V1';
$username = 'root';
$password = '';
$jsonFile = 'api/news.json';

$newsManager = new NewsManager($host, $dbname, $username, $password, $jsonFile);

header('Content-Type: application/json');


$method = $_SERVER['REQUEST_METHOD'];
$data = json_decode(file_get_contents('php://input'), true);

if ($method === 'POST') {

    // Create //
    $title = $data['naam'];
    $content = $data['txt'];
    $imagePath = $data['img'];

    $result = $newsManager->newsCreate($title, $content, $imagePath);
    echo json_encode($result);
} elseif ($method === 'PATCH') {
    
    // Update //
    $id = $data['id'];
    $title = $data['naam'];
    $content = $data['txt'];
    $imagePath = $data['img'];

    $result = $newsManager->newsUpdate($id, $title, $content, $imagePath);
    echo json_encode($result);

} else {
    echo json_encode(['status' => 'error', 'message' => 'Api error']);
}

?>
