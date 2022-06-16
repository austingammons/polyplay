
let Genre = {
    CurrentQuestion: 0,
    CurrentOptions: [],
    Results: [],
    Back: function () {

        let currentQuestionElement = document.getElementById("question_" + Genre.CurrentQuestion);

        currentQuestionElement.classList.remove("question-visible");
        currentQuestionElement.classList.add("question-hidden");

        --Genre.CurrentQuestion;

        Genre.CurrentOptions = Genre.Results[Genre.CurrentQuestion];

        let previousQuestion = document.getElementById("question_" + Genre.CurrentQuestion);

        previousQuestion.classList.remove("question-hidden");
        previousQuestion.classList.add("question-visible");

    },
    Next: function () {

        if (Genre.CurrentOptions.length == 0) {
            Genre.CurrentOptions = Genre.Results[Genre.CurrentQuestion];
        } else {
            Genre.Results[Genre.CurrentQuestion] = Genre.CurrentOptions;
        }

        let rating = [];

        for (let index = 0; index < Genre.CurrentOptions.length; index++) {

            rating.push(Genre.CurrentOptions[index].Value);
            
        }

        let option_rating = document.getElementById("option_rating_" + Genre.CurrentQuestion);
        option_rating.value = rating;

        Genre.CurrentOptions = [];

        // change question

        if (Genre.CurrentQuestion == 11) {
            let dvGenreExamComplete = document.getElementById("dvGenreExamComplete");
            let dvGenreExamQuestions = document.getElementById("dvGenreExamQuestions");
            dvGenreExamQuestions.style.display = "none";
            dvGenreExamComplete.style.display = "block";
            return 1;
        } else {
            let currentQuestionElement = document.getElementById("question_" + Genre.CurrentQuestion);

            currentQuestionElement.classList.remove("question-visible");
            currentQuestionElement.classList.add("question-hidden");

            ++Genre.CurrentQuestion;

            let nextQuestion = document.getElementById("question_" + Genre.CurrentQuestion);

            nextQuestion.classList.remove("question-hidden");
            nextQuestion.classList.add("question-visible");
        }

    },
    Rate: function (checkbox, label, checked) {

        let currentOptionsLength = Genre.CurrentOptions.length;
        let question_index = checkbox.name.substr(-1);
        let lastOption = null;

        let selectedOption = {
            Id: checkbox.id,
            Name: checkbox.name,
            Value: checkbox.value,
            Question: question_index,
            Text: label.innerText
        }

        for (let index = 0; index < Genre.CurrentOptions.length; index++) {
            if (Genre.CurrentOptions[index].Question == question_index) {
                if (currentOptionsLength) {
                    Genre.CurrentOptions.pop();
                }
            }
            
        }

        if (Genre.CurrentOptions[Genre.CurrentQuestion] == question_index) {
            
        }

        Genre.CurrentOptions.push(selectedOption);

    },
}