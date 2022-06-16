<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/classes/exam.php';
require __DIR__ . '/../src/routes/exam.php';
require_login();

$exam = new ExamNew();

// END
?>

<?php view('header', ['title' => 'Exam']); ?>

<div>

    <?php if($exam->user_has_incomplete_test()): ?>
        <div>Please complete the exam currently in progress before starting a new exam.</div>
        <?php echo $exam->get_incomplete_test(); ?>
    <?php else: ?>
        <form action="exam.php" method="post">
            <button type="submit" class="btn-win">Start Exam</button>
        </form>
        <br />
        <a href="index.php">Return Home</a>
    <?php endif; ?>



</div>