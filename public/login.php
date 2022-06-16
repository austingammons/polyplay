<?php

require __DIR__ . '/../src/bootstrap.php';
require __DIR__ . '/../src/routes/login.php';
?>

<?php view('header', ['title' => 'Login']) ?>

<?php if (isset($errors['login'])) : ?>
    <div class="alert alert-error">
        <?= $errors['login'] ?>
    </div>
<?php endif ?>


<form action="login.php" method="post">
    <h1>Login</h1>
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" class="win-input" value="<?= $inputs['username'] ?? '' ?>">
        <small><?= $errors['username'] ?? '' ?></small>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="win-input">
        <small><?= $errors['password'] ?? '' ?></small>
    </div>
    <section>
        <button type="submit" class="win-btn-success">Login</button>
        Need an account? <a href="register.php">Register</a>
    </section>
</form>


<?php view('footer') ?>