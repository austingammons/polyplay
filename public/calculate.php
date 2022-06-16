<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/classes/exam.php';
require __DIR__ . '/../src/routes/calculate.php';
require_login();

$exam = new ExamNew();
$personality = [];

if ($exam->user_has_incomplete_test()) {
    echo "incomplete exam exists";
} else {
    echo "complete exam available";

    $last_exam = $exam->get_last_exam();
    $exam_id = $last_exam["exam_id"];

    $personality = $exam->get_personality($exam_id);
}

// END
?>

<?php view('header', ['title' => 'Calculate']); ?>

<div>

    <?php if($exam->user_has_incomplete_test()): ?>
        <div>Please complete the exam currently in progress.</div>
    <?php else: ?>
        <div>Exam complete!</div>

        <?php if(!empty($personality)): ?>
            <h2>You are <?php echo $personality["Personality"]; ?>!</h2>
            <small><?php echo $personality["Primary"]; ?>/<?php echo $personality["Secondary"]; ?></small>
            <div class="description">
                <?php echo $personality["Description"]; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>

    <a href="index.php">Return Home</a>


</div>