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
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: auto;
            padding: 30px;
        }

        fieldset {
            border: none;
            margin-bottom: 20px;
        }

        legend {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #2c3e50;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 1rem;
            color: #34495e;
        }

        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 10px;
        }

        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
            font-size: 1rem;
            background-color: #f9f9f9;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 1.1rem;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .survey-section {
            margin-bottom: 30px;
        }

        .answer-option {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .answer-option input {
            margin-right: 12px;
        }

        .answer-option select {
            margin-top: 10px;
        }

    </style>
</head>
<body>
    <h1>Vul de enquête in</h1>

    <form method="POST" action="survey.php">
        <?php foreach ($questions as $question): ?>
            <fieldset class="survey-section">
                <legend><?= htmlspecialchars($question['vraag']) ?></legend>
                
                <?php if ($question['type'] == 'radio'): ?>
                    <?php
                    // Display radio options
                    $options = explode(',', $question['opties']);
                    foreach ($options as $option):
                    ?>
                        <div class="answer-option">
                            <input type="radio" name="answers[<?= $question['id'] ?>]" value="<?= htmlspecialchars($option) ?>" id="radio_<?= $question['id'] ?>_<?= htmlspecialchars($option) ?>">
                            <label for="radio_<?= $question['id'] ?>_<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></label>
                        </div>
                    <?php endforeach; ?>

                <?php elseif ($question['type'] == 'checkbox'): ?>
                    <?php
                    // Display checkbox options
                    $options = explode(',', $question['opties']);
                    foreach ($options as $option):
                    ?>
                        <div class="answer-option">
                            <input type="checkbox" name="answers[<?= $question['id'] ?>][]" value="<?= htmlspecialchars($option) ?>" id="checkbox_<?= $question['id'] ?>_<?= htmlspecialchars($option) ?>">
                            <label for="checkbox_<?= $question['id'] ?>_<?= htmlspecialchars($option) ?>"><?= htmlspecialchars($option) ?></label>
                        </div>
                    <?php endforeach; ?>

                <?php elseif ($question['type'] == 'dropdown'): ?>
                    <select name="answers[<?= $question['id'] ?>]" id="dropdown_<?= $question['id'] ?>">
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
