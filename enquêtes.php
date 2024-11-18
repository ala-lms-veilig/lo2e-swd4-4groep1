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

<script>

// Fetch and display the survey
async function showSurvey() {
    const response = await fetch('api/survey.json'); // Replace with your survey JSON URL
    const survey = await response.json();

    console.log(survey);
    
    // Inject the survey title and description
    const titleElement = document.getElementById('survey-title');
    const descriptionElement = document.getElementById('survey-description');
    titleElement.textContent = survey.survey.title;
    descriptionElement.textContent = survey.survey.description;
    
    // Container for survey questions
    const container = document.getElementById('survey-container');
    const template = document.getElementById('question_template');

    // Loop through each question and render it
    for (let question of survey.survey.questions) {
        const clone = template.content.cloneNode(true);

        const label = clone.querySelector('.question-label');
        const content = clone.querySelector('.question-content');

        label.textContent = question.question;

        if (question.type === 'multiple_choice' || question.type === 'checkbox') {
            question.options.forEach(option => {
                const input = document.createElement('input');
                input.type = question.type === 'multiple_choice' ? 'radio' : 'checkbox';
                input.name = `question-${question.id}`;
                input.value = option;

                const optionLabel = document.createElement('label');
                optionLabel.textContent = option;

                content.appendChild(input);
                content.appendChild(optionLabel);
                content.appendChild(document.createElement('br'));
            });
        } else if (question.type === 'rating') {
            for (let i = question.scale.min; i <= question.scale.max; i++) {
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = `question-${question.id}`;
                input.value = i;

                const ratingLabel = document.createElement('label');
                ratingLabel.textContent = i;

                content.appendChild(input);
                content.appendChild(ratingLabel);
                content.appendChild(document.createElement('br'));
            }
        } else if (question.type === 'yes_no') {
            ['Yes', 'No'].forEach(option => {
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = `question-${question.id}`;
                input.value = option;

                const yesNoLabel = document.createElement('label');
                yesNoLabel.textContent = option;

                content.appendChild(input);
                content.appendChild(yesNoLabel);
                content.appendChild(document.createElement('br'));
            });
        } else if (question.type === 'open_ended') {
            const textarea = document.createElement('textarea');
            textarea.name = `question-${question.id}`;
            content.appendChild(textarea);
        }

        container.appendChild(clone);
    }
}

showSurvey();
</script>

</body>
</html>
