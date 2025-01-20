<?php

require_once 'EnqueteCRUD.php';


$crud = new EnqueteCRUD();


if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $crud->delete($id); 
    header("Location: enquete_admin.php"); 
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-question'])) {
    $vraag = $_POST['vraag'];
    $type = $_POST['type'];
    $opties = $_POST['opties'] ?? null;
    $crud->addQuestion($vraag, $type, $opties); 
    header("Location: enquete_admin.php"); 
    exit;
}

$questions = $crud->getQuestionsFromDB();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquête Beheer</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #4CAF50;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        button, a {
            padding: 8px 16px;
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover, a:hover {
            background-color: #45a049;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        form h2 {
            color: #4CAF50;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        textarea, select, input[type="text"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="text"], select {
            font-size: 14px;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Beheer van Enquête Vragen</h1>


    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Vraag</th>
                <th>Type</th>
                <th>Opties</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
                <tr>
                    <td><?= htmlspecialchars($question['id']) ?></td>
                    <td><?= htmlspecialchars($question['vraag']) ?></td>
                    <td><?= htmlspecialchars($question['type']) ?></td>
                    <td><?= htmlspecialchars($question['opties'] ?? 'N/A') ?></td>
                    <td>
                        <a href="?delete=<?= $question['id'] ?>" onclick="return confirm('Weet je zeker dat je deze vraag wilt verwijderen?')">Verwijder</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

   
    <h2>Nieuwe Vraag Toevoegen</h2>
    <form method="POST" action="enquete_admin.php">
        <label for="vraag">Vraag:</label>
        <textarea id="vraag" name="vraag" required></textarea>

        <label for="type">Type Vraag:</label>
        <select id="type" name="type" required>
            <option value="text">Tekstinvoer</option>
            <option value="radio">Meerkeuze (radio)</option>
            <option value="checkbox">Meerkeuze (checkbox)</option>
            <option value="dropdown">Keuzelijst</option>
        </select>

        <label for="opties">Opties (alleen voor radio, checkbox, dropdown - scheid opties met een komma):</label>
        <input type="text" id="opties" name="opties">

        <button type="submit" name="add-question">Vraag Toevoegen</button>
    </form>
</body>
</html>
