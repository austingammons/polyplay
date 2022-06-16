<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/classes/exam.php';

require_login();

$exam = new ExamNew();
$all_user_exams = $exam->get_all_user_exams();

?>

<?php view('header', ['title' => 'Dashboard']) ?>

<div>

    <h2>Exam Scores</h2>

    <table class="poly-table">
        <thead>
            <th>Personality</th>
            <th>Primary</th>
            <th>Secondary</th>
            <th>Control</th>
            <th>Concept</th>
            <th>Computation</th>
            <th>Community</th>
        </thead>
        <tbody>
            <?php if (count($all_user_exams)): ?>
                <?php foreach($all_user_exams as $exam_index => $exam_data): ?>
                    <tr>
                        <td>
                            <?php echo $exam_data["Personality"]; ?>
                        </td>
                        <td>
                            <?php echo $exam_data["Primary"]; ?>
                        </td>
                        <td>
                            <?php echo $exam_data["Secondary"]; ?>
                        </td>
                        <td>
                            <?php echo $exam_data["Points"]["Control"]; ?>%
                        </td>
                        <td>
                            <?php echo $exam_data["Points"]["Concept"]; ?>%
                        </td>
                        <td>
                            <?php echo $exam_data["Points"]["Computation"]; ?>%
                        </td>
                        <td>
                            <?php echo $exam_data["Points"]["Community"]; ?>%
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" style="text-align:center;">No Results</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php view('footer') ?>