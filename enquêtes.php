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

async function showSurvey() {
    const response = await fetch('api/survey.json');
    const survey = await response.json();

    console.log(survey);

    const titleElement = document.getElementById('survey-title');
    const descriptionElement = document.getElementById('survey-description');
    titleElement.textContent = survey.survey.title;
    descriptionElement.textContent = survey.survey.description;

    const container = document.getElementById('survey-container');
    const template = document.getElementById('question_template');

    for (let question of survey.survey.questions) {
        const clone = template.content.cloneNode(true);

        const label = clone.querySelector('.question-label');
        const content = clone.querySelector('.question-content');

        label.textContent = question.question;

        if (question.type === 'multiple_choice' || question.type === 'checkbox') {
            for (let option of question.options) {
                const input = document.createElement('input');
                input.type = (question.type === 'multiple_choice') ? 'radio' : 'checkbox';
                input.name = 'question-' + question.id;
                input.value = option;

                const optionLabel = document.createElement('label');
                optionLabel.textContent = option;

                content.appendChild(input);
                content.appendChild(optionLabel);
                content.appendChild(document.createElement('br'));
            }
        } else if (question.type === 'rating') {
            for (let i = question.scale.min; i <= question.scale.max; i++) {
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'question-' + question.id;
                input.value = i;

                const ratingLabel = document.createElement('label');
                ratingLabel.textContent = i;

                content.appendChild(input);
                content.appendChild(ratingLabel);
                content.appendChild(document.createElement('br'));
            }
        } else if (question.type === 'yes_no') {
            const yesNoOptions = ['Yes', 'No'];
            for (let option of yesNoOptions) {
                const input = document.createElement('input');
                input.type = 'radio';
                input.name = 'question-' + question.id;
                input.value = option;

                const yesNoLabel = document.createElement('label');
                yesNoLabel.textContent = option;

                content.appendChild(input);
                content.appendChild(yesNoLabel);
                content.appendChild(document.createElement('br'));
            }
        } else if (question.type === 'open_ended') {
            const textarea = document.createElement('textarea');
            textarea.name = 'question-' + question.id;
            content.appendChild(textarea);
        }

        container.appendChild(clone);
    }
}

async function submitSurvey() {
    const form = document.getElementById('survey-form');
    const formData = {};

    const formElements = form.elements;
    for (let element of formElements) {
        if (element.type === 'radio' || element.type === 'checkbox') {
            if (element.checked) {
                if (!formData[element.name]) {
                    formData[element.name] = [];
                }
                formData[element.name].push(element.value);
            }
        } else if (element.type === 'textarea') {
            formData[element.name] = element.value;
        }
    }

    const response = await fetch('api/survey.json', {
        method: 'POST',
        body: JSON.stringify(formData),
        headers: {
            'Content-type': 'application/json; charset=UTF-8',
        },
    });

    const result = await response.json();
    console.log(result);
}

const submitButton = document.getElementById('submit-survey');
submitButton.addEventListener('click', submitSurvey);

showSurvey();

</script>

</body>
</html>
<script src="scripts/enquete.js"></script>

 