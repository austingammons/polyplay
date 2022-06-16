
let Preference = {
    CurrentQuestion: 0,
    CurrentOptions: [],
    Results: [
        [],
        [],
        [],
        [],
        [],
        [],
        [],
        [],
    ],
    Back: function () {

        let currentQuestionElement = document.getElementById("question_" + Preference.CurrentQuestion);

        currentQuestionElement.classList.remove("question-visible");
        currentQuestionElement.classList.add("question-hidden");

        --Preference.CurrentQuestion;

        Preference.CurrentOptions = Preference.Results[Preference.CurrentQuestion];

        let previousQuestion = document.getElementById("question_" + Preference.CurrentQuestion);

        previousQuestion.classList.remove("question-hidden");
        previousQuestion.classList.add("question-visible");

    },
    Next: function () {

        if (Preference.CurrentOptions.length == 0) {
            Preference.CurrentOptions = Preference.Results[Preference.CurrentQuestion];
        } else {
            Preference.Results[Preference.CurrentQuestion] = Preference.CurrentOptions;
        }

        let rating = [];

        for (let index = 0; index < Preference.CurrentOptions.length; index++) {

            rating.push(Preference.CurrentOptions[index].Value);
            
        }

        let option_rating = document.getElementById("option_rating_" + Preference.CurrentQuestion);
        option_rating.value = rating;

        Preference.CurrentOptions = [];

        // change question

        if (Preference.CurrentQuestion == 5) {
            let dvPreferenceExamComplete = document.getElementById("dvPreferenceExamComplete");
            dvPreferenceExamComplete.style.display = "block";

            let dvPreferenceQuestions = document.getElementById("dvPreferenceQuestions");
            dvPreferenceQuestions.style.display = "none";
            return 1;
        } else {
            let currentQuestionElement = document.getElementById("question_" + Preference.CurrentQuestion);

            currentQuestionElement.classList.remove("question-visible");
            currentQuestionElement.classList.add("question-hidden");

            ++Preference.CurrentQuestion;

            let nextQuestion = document.getElementById("question_" + Preference.CurrentQuestion);

            nextQuestion.classList.remove("question-hidden");
            nextQuestion.classList.add("question-visible");
        }

    },
    Rate: function (checkbox, label, checked) {

        let currentOptionsLength = Preference.CurrentOptions.length;
        let question_index = checkbox.name.substr(-1);
        let lastOption = null;

        let selectedOption = {
            Id: checkbox.id,
            Name: checkbox.name,
            Value: checkbox.value,
            Question: question_index,
            Text: label.innerText
        }

        if (checked) {

            if (Preference.CurrentOptions.length > 0) {
                var disableLastOption = Preference.CurrentOptions[Preference.CurrentOptions.length - 1];
                let elementToDisable = document.getElementById(disableLastOption.Id);
                elementToDisable.disabled = true;
            }

            Preference.CurrentOptions.push(selectedOption);

            label.innerText += "(" + Preference.CurrentOptions.length + ")";


        } else {

            label.innerText = label.innerText.split('(')[0];

            Preference.CurrentOptions.pop();

            if (Preference.CurrentOptions.length > 0) {
                var enableLastOption = Preference.CurrentOptions[Preference.CurrentOptions.length - 1];
                let elementToEnable = document.getElementById(enableLastOption.Id);
                elementToEnable.disabled = false;
            }

        }

    },
}