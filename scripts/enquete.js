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

showSurvey();