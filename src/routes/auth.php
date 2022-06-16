<?php

/**
* Register a user
*
* @param string $email
* @param string $username
* @param string $password
* @param bool $is_admin
* @return bool
*/
function register_user(string $email, string $username, string $password, bool $is_admin = false): bool
{
    $sql = 'INSERT INTO users(username, email, password, is_admin)
            VALUES(:username, :email, :password, :is_admin)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $statement->bindValue(':is_admin', (int)$is_admin, PDO::PARAM_INT);


    return $statement->execute();
}

function find_user_by_username(string $username)
{
    $sql = 'SELECT username, password, id
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function login(string $username, string $password): bool
{
    $user = find_user_by_username($username);

    // if user found, check the password
    if ($user && password_verify($password, $user['password'])) {

        // prevent session fixation attack
        session_regenerate_id();

        // set username in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id']  = $user['id'];

        var_dump($_SESSION);


        return true;
    }

    return false;
}

function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}

function require_login(): void
{
    if (!is_user_logged_in()) {
        redirect_to('login.php');
    }
}

function current_user()
{
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

function logout(): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
        redirect_to('login.php');
    }
}

function dashboard()
{

}

function create_preference_test(int $user_id, int $exam_id, int $pref_control_score, int $pref_concept_score, int $pref_computation_score, int $pref_community_score): bool
{

    $sql = 'INSERT INTO preferences(user_id, exam_id, pref_control_score, pref_concept_score, pref_computation_score, pref_community_score)
            VALUES(:user_id, :exam_id, :pref_control_score, :pref_concept_score, :pref_computation_score, :pref_community_score)';

    $db = db();

    $statement = $db->prepare($sql);

    $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
    $statement->bindValue(':exam_id', (int)$exam_id, PDO::PARAM_INT);
    $statement->bindValue(':pref_control_score', (int)$pref_control_score, PDO::PARAM_INT);
    $statement->bindValue(':pref_concept_score', (int)$pref_concept_score, PDO::PARAM_INT);
    $statement->bindValue(':pref_computation_score', (int)$pref_computation_score, PDO::PARAM_INT);
    $statement->bindValue(':pref_community_score', (int)$pref_community_score, PDO::PARAM_INT);


    return $statement->execute();

}

function save_genre_ratings(int $user_id, int $exam_id, int $gen_control_score, int $gen_concept_score, int $gen_computation_score, int $gen_community_score) {

    $sql = 'INSERT INTO genres(user_id, exam_id, gen_control_score, gen_concept_score, gen_computation_score, gen_community_score)
            VALUES(:user_id, :exam_id, :gen_control_score, :gen_concept_score, :gen_computation_score, :gen_community_score)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':user_id', (int)$user_id, PDO::PARAM_INT);
    $statement->bindValue(':exam_id', (int)$exam_id, PDO::PARAM_INT);
    $statement->bindValue(':gen_control_score', (int)$gen_control_score, PDO::PARAM_INT);
    $statement->bindValue(':gen_concept_score', (int)$gen_concept_score, PDO::PARAM_INT);
    $statement->bindValue(':gen_computation_score', (int)$gen_computation_score, PDO::PARAM_INT);
    $statement->bindValue(':gen_community_score', (int)$gen_community_score, PDO::PARAM_INT);


    return $statement->execute();

}