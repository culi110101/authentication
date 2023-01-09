<?php
// var_dump($_COOKIE["accountname_error"]);
?>

<div class="home">
    <div class="login-form">
        <img src="http://localhost/learn/Final_Project/assets/imgs/logo.svg" alt="">
        <h1 class="header">Login to your account</h1>
        <form action="?page=login&action=login" method="POST">
            <div class="mb-3">
                <p for="accountname">Username:</p>
                <input type="text" name="accountname">
                <?php if (isset($_COOKIE["accountname_error"])) : ?>
                    <p class="error-message"><?= $_COOKIE["accountname_error"] ?></p>
                <?php endif ?>
            </div>
            <div>
                <p for="password">Password:</p>
                <input type="password" name="password">
                <?php if (isset($_COOKIE["password_error"])) : ?>
                    <p class="error-message"><?= $_COOKIE["password_error"] ?></p>
                <?php endif ?>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="register-btn">
            <a href="?page=register">Register</a>
        </div>
    </div>
</div>