<?php

if (!is_user_logged_in()) {
    redirect_to('index.php');
}

// Requests
if (is_post_request()) {

    $option_ratings = $_POST["option_rating"];
    $exam_id = $_POST["exam_id"];

    $preference_exam = new PreferenceExam();
    $ratings = $preference_exam->calculate_preference_exam_points($option_ratings, $exam_id);

    $new_preference_record_id = $preference_exam->create($exam_id, $ratings["Control"], $ratings["Concept"], $ratings["Computation"], $ratings["Community"]);

    // take phase two exam
    redirect_to("genres.php");

} else if (is_get_request()) {
    
    // starting test
    echo "is a get request";

}
