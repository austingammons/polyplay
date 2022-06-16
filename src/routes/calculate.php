<?php

// Login Required
if (!is_user_logged_in()) {
    redirect_to('index.php');
}

// Request
if (is_post_request()) {

    echo "is post request";

} else if (is_get_request()) {

    echo "is get request";
}