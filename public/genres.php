<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/classes/genre_exam.php';
require __DIR__ . '/../src/routes/genres.php';

view('header', ['title' => 'Preferences']);
require_login();

$genre_exam = new GenreExam();
$test = $genre_exam->get_genre_exam_questions();

$exam = new ExamNew();
$last_exam = $exam->get_last_exam();
$exam_id = $last_exam["exam_id"];

?>

<form action="genres.php" method="post">
    
    <input name="exam_id" value="<?php echo $exam_id; ?>" type="hidden">
    
    <h2>Taking Genre Exam</h2>
    <p><b>Instructions:</b> Select your favorite game genre.</p>

    <div id="dvGenreExamQuestions">
    
        <?php foreach($test as $question_index => $question): ?>
            <div id="question_<?php echo $question_index; ?>" class="question-hidden">

                <input id="<?= "option_rating_" . $question_index; ?>" name="option_rating[]" type="hidden">
                <h4>Question <?= (int)$question_index + 1 ?> of 12</h4>

                <?php
                    $cb_name = "cbQuestion_" . $question_index;
                    $option_ratings = "option_ratings[question_" . $question_index . "]";
                ?>

                <?php foreach($question as $option_index => $option): ?>

                    <?php
                        $option_id = "cbOptionId_" . $option["OptionId"] . $option["CategoryText"] . "_" . $option["CategoryId"] . "_" . $question_index;
                        $option_value = $option["CategoryText"];
                    ?>

                    <div id="option_<?php echo $option_index; ?>" class="option">
                        <input id="<?= $option_id; ?>" onclick="OnClick_RateOption(event)" type="radio" name="<?= $cb_name; ?>" value="<?= $option_value; ?>" />
                        <label for="<?= $option_id; ?>">
                            <?php echo $option["OptionText"]; ?>
                        </label>
                    </div>

                <?php endforeach; ?>

                <button class="win-btn win-btn-success" type="button" onclick="OnClick_Next()">Next</button>
                <button class="win-btn win-btn-primary" type="button" onclick="OnClick_Back()">Previous</button>

            </div>
        <?php endforeach; ?>

    </div>

    <div id="dvGenreExamComplete" class="text-center">
        <p>The Genre Phase is complete.</p>
        <button type="submit" class="win-btn-success">Continue</button>
    </div>

    <br />

    <a class="" href="index.php">Return to Dashboard</a>
</form>

<?php view('footer') ?>

<script src="scripts/exam.js" rel="text/javascript"></script>
<script src="scripts/genre.js" rel="text/javascript"></script>

<script type="text/javascript">

function runOnStart() {
    Exam.Start();
}
if(document.readyState !== 'loading') {
    runOnStart();
}
else {
    document.addEventListener('DOMContentLoaded', function () {
        runOnStart()
    });
}

function OnClick_RateOption(event) {

    let radio = event.target;
    let label = event.target.parentElement.children[1];
    let checked = event.target.checked;

    Genre.Rate(radio, label, checked);
}

function OnClick_Next() {
    Genre.Next();
}

function OnClick_Back() {
    Genre.Back();
}

function OnClick_ViewResults() {
    Genre.ViewResults();
}

</script>
