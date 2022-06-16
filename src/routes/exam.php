<?php

// Login Required
if (!is_user_logged_in()) {
    redirect_to('index.php');
}

// Request
if (is_post_request()) {

    $exam = new ExamNew();
    $record = $exam->create();
    redirect_to("preferences.php");

} else if (is_get_request()) {

    $exam = new ExamNew();
    $all = $exam->all();

}