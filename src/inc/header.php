<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css" type="text/css">
    <!-- <link rel="stylesheet" href="styles/bootstrap.css" type="text/css"> -->
    <title><?= $title ?? 'Home' ?></title>
</head>

<body>

<div class="stage-header">
    <?php if(isset($_SESSION["user_id"])): ?>
        <a class="stage-header-item" href="index.php">Home</a>
        <a class="stage-header-item" href="exam.php">Exam</a>
        <a class="stage-header-item" href="logout.php">Logout</a>
    <?php else: ?>
        <a class="stage-header-item" href="login.php">Login</a>
        <a class="stage-header-item" href="register.php">Register</a>
    <?php endif; ?>
</div>

<main>
<?php flash() ?>
