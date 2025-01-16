<?php
// Include the EnqueteCRUD class
require_once 'EnqueteCRUD.php';

// Create an instance of EnqueteCRUD
$crud = new EnqueteCRUD();

// Check if we need to update the JSON file from the database
$crud->updateJsonFile(); // This will update the JSON file with the latest questions from the database

// Fetch questions from the JSON file
$questions = $crud->getQuestionsFromJson();

// Handle form submission (survey responses)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect answers from the form
    $answers = $_POST['answers'];

    // Optionally, store the answers in a database or handle them as needed
    // Here, we just print the answers for demonstration
    echo "<h3>Uw Antwoorden:</h3>";
    foreach ($answers as $id => $answer) {
        // Check if the answer is an array (for checkboxes)
        if (is_array($answer)) {
            $answer = implode(', ', $answer); // Convert checkbox answers to a comma-separated string
        }
        echo "Vraag ID: $id - Antwoord: $answer<br>";
    }
    exit; // End the script after processing the answers
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquête</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        fieldset {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        legend {
            font-weight: bold;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Vul de enquête in</h1>

    <form method="POST" action="survey.php">
        <?php foreach ($questions as $question): ?>
            <fieldset>
                <legend><?= htmlspecialchars($question['vraag']) ?></legend>
                
                <?php if ($question['type'] == 'radio'): ?>
                    <?php
                    // Display radio options
                    $options = explode(',', $question['opties']);
                    foreach ($options as $option):
                    ?>
                        <label>
                            <input type="radio" name="answers[<?= $question['id'] ?>]" value="<?= htmlspecialchars($option) ?>">
                            <?= htmlspecialchars($option) ?>
                        </label><br>
                    <?php endforeach; ?>

                <?php elseif ($question['type'] == 'checkbox'): ?>
                    <?php
                    // Display checkbox options
                    $options = explode(',', $question['opties']);
                    foreach ($options as $option):
                    ?>
                        <label>
                            <input type="checkbox" name="answers[<?= $question['id'] ?>][]" value="<?= htmlspecialchars($option) ?>">
                            <?= htmlspecialchars($option) ?>
                        </label><br>
                    <?php endforeach; ?>

                <?php elseif ($question['type'] == 'dropdown'): ?>
                    <select name="answers[<?= $question['id'] ?>]">
                        <?php
                        // Display dropdown options
                        $options = explode(',', $question['opties']);
                        foreach ($options as $option):
                        ?>
                            <option value="<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></option>
                        <?php endforeach; ?>
                    </select>

                <?php elseif ($question['type'] == 'text'): ?>
                    <textarea name="answers[<?= $question['id'] ?>]" rows="4" cols="50"></textarea>
                <?php endif; ?>
            </fieldset>
        <?php endforeach; ?>

        <button type="submit">Verzenden</button>
    </form>
</body>
</html>
