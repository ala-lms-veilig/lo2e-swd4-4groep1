<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquête over Veiligheid</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
 
    <?php require_once 'includes/header.php'; ?>

    <main id="enquêtes_main">
        <h1 id="survey-title"></h1>
        <p id="survey-description"></p>
        <div id="survey-container"></div>
        <button type="submit">Submit</button>

        <!-- Template -->
        <template id="question_template">
          <div class="question">
            <label class="question-label"></label>
            <div class="question-content"></div>
          </div>
        </template>
    </main>
 
    <?php require_once 'includes/footer.php'; ?>
 

    <script src="scripts/enquete.js"></script>
</body>
</html>


 