<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey on Safety</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

    <?php require 'includes/header.php'; ?>

    <main id="survey_main">
        <h2>Survey on Safety</h2>
        <form id="surveyForm">
            <template id="question_template">
                <label class="question_text"></label>
                <div>
                    <input type="radio" name="answer" value="1"> 1
                    <input type="radio" name="answer" value="2"> 2
                    <input type="radio" name="answer" value="3"> 3
                    <input type="radio" name="answer" value="4"> 4
                    <input type="radio" name="answer" value="5"> 5
                    <input type="radio" name="answer" value="6"> 6
                    <input type="radio" name="answer" value="7"> 7
                    <input type="radio" name="answer" value="8"> 8
                    <input type="radio" name="answer" value="9"> 9
                    <input type="radio" name="answer" value="10"> 10
                </div>
            </template>
            <div id="questions_container"></div>
            <button type="submit" id="submitBtn">Submit</button>
        </form>
    </main>

    <?php require 'includes/footer.php'; ?>

    <script>
        async function fetchQuestions() {
            const response = await fetch('https://my-json-server.typicode.com/ala-lms-veilig/lo2e-swd4-4groep1/questions');
            const questions = await response.json();
            return questions;
        }

        async function renderQuestions() {
            const questions = await fetchQuestions();
            const template = document.getElementById("question_template");
            const container = document.getElementById("questions_container");

            questions.forEach((question, index) => {
                const clone = template.content.cloneNode(true);
                const questionLabel = clone.querySelector(".question_text");
                questionLabel.textContent = question.vraag;
                const radioInputs = clone.querySelectorAll('input[type="radio"]');
                radioInputs.forEach(input => {
                    input.name = `vraag${index + 1}`;
                });
                container.appendChild(clone);
            });
        }

        document.getElementById("surveyForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const answers = [];
            const questionCount = document.querySelectorAll('.question_text').length;

            for (let i = 0; i < questionCount; i++) {
                const answer = document.querySelector(`input[name="vraag${i + 1}"]:checked`);
                if (answer) {
                    answers.push({ vraag: `Vraag ${i + 1}`, antwoord: answer.value });
                }
            }

            console.log(answers);
            alert("Thank you for participating in the survey!");
        });

        renderQuestions();
    </script>

</body>
</html>
