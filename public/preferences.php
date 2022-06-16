<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/classes/preference_exam.php';
require __DIR__ . '/../src/routes/preferences.php';

view('header', ['title' => 'Preferences']);
require_login();

$preference_exam = new PreferenceExam();
$test = $preference_exam->get_preference_exam_questions();


$exam = new ExamNew();
$current_exam = $exam->get_last_exam();
$exam_id = $current_exam["exam_id"];

?>

<form action="preferences.php" method="post">
    <div>
        
    <input name="exam_id" value="<?php echo $exam_id; ?>" type="hidden">
        
    <h2>Taking Preference Exam</h2>
    <p><b>Instructions:</b> Rate each option from most preferred to least preferred.</p>
       
    <div id="dvPreferenceQuestions">



        <?php foreach ($test as $question_index => $question): ?>

            <div id="question_<?php echo $question_index; ?>" class="question-hidden">

                <input id="<?= "option_rating_" . $question_index; ?>" name="option_rating[]" type="hidden">
                <h4>Question <?= (int)$question_index + 1 ?> of 6</h4>


                <div>

                    <?php
                        // set the checkbox name used for options
                        $cb_name = "cbQuestion_" . $question_index;
                        $option_ratings = "option_ratings[question_" . $question_index . "]";

                    ?>

                    <?php foreach ($question as $option_index => $option): ?>
                        <!-- Start Option -->
                        <?php
                            // set the option_id and option_value to use in the HTML
                            $option_id = "cbOptionId_" . $option["OptionId"] . $option["CategoryText"] . "_" . $option["CategoryId"];
                            $option_value = $option["CategoryText"];

                        ?>

                        <div id="option_<?php echo $option_index; ?>" class="option">
                            <input id="<?= $option_id; ?>" onclick="OnClick_RateOption(event)" type="checkbox" name="<?= $cb_name; ?>" value="<?= $option_value; ?>" />
                            <label for="<?= $option_id; ?>">
                                <?= $option["OptionText"]; ?>
                            </label>
                        </div>
                
                    <!-- End Option -->
                    <?php endforeach; ?>

                </div>


                <button class="win-btn win-btn-success" type="button" onclick="OnClick_Next()">Next</button>
                <button class="win-btn win-btn-primary" type="button" onclick="OnClick_Back()">Previous</button>

            </div>
            <!-- End Question -->
        <?php endforeach; ?>



    </div>

        <div id="dvPreferenceExamComplete" class="text-center">
            The preference exam is complete.
            <button type="submit" class="win-btn-success">Continue</button>
        </div>

        <br />

        <a class="" href="index.php">Return to Dashboard</a>

    </div>

</form>


<?php view('footer') ?>

<script src="scripts/exam.js" rel="text/javascript"></script>
<script src="scripts/preference.js" rel="text/javascript"></script>

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

        let checkbox = event.target;
        let label = event.target.parentElement.children[1];
        let checked = event.target.checked;

        Preference.Rate(checkbox, label, checked);
    }

    function OnClick_Next() {
        Preference.Next();
    }

    function OnClick_Back() {
        Preference.Back();
    }

</script>