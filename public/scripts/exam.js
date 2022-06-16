

let Exam = {
    Start: function () {
        let questions = document.getElementsByClassName("question-hidden");
        let first_question = questions[0];
        first_question.classList.remove("question-hidden");
        first_question.classList.add("question-visible");

    }
}