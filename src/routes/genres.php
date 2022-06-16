<?php

if (!is_user_logged_in()) {
    redirect_to('index.php');
}

$options = [];

if (is_post_request()) {

    echo "is post request";

    $option_ratings = $_POST["option_rating"];
    $exam_id = $_POST["exam_id"];

    $genre_exam = new GenreExam();
    $ratings = $genre_exam->calculate_genre_exam_points($option_ratings, $exam_id);

    $new_genre_record_id = $genre_exam->create($exam_id, $ratings["Control"], $ratings["Concept"], $ratings["Computation"], $ratings["Community"]);

    redirect_to("calculate.php");

} else if (is_get_request()) {
    
    echo "is get request";

}
