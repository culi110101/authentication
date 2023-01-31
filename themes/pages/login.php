<?php
// var_dump($_COOKIE["accountname_error"]);
?>

<div class="home">
    <div class="container mt-auto login-form d-flex">
        <div class="col-5 login-form__design">
            <div>
                <img src="http://localhost/learn/Final_Project/assets/imgs/vertical_logo.png" alt="">
                <h2>Thiết kế web chuyển SEO</h2>
                <p>Dẫn đầu công nghệ</p>
                LPtech dẫn đầu trong lĩnh vực SEO và Digital Marketing vơí hơn 10 năm kinh nghiệm và đội ngũ nhân viên chuyên nghiệp đào tạo chuyên sâu
            </div>
        </div>
        <div class="col-7 login-form__content d-flex align-items-center">
            <div class="w-100">
                <h1 class="header">Login</h1>
                <?php if (isset($_COOKIE["login_error"])) : ?>
                    <div class="error-message">
                        <p><?= $_COOKIE["login_error"] ?></p>
                    </div>
                <?php endif ?>
                <form action="?page=login&action=login" method="POST">
                    <div class="mb-3">
                        <input type="text" name="accountname" placeholder="Your Account Name">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Your Password" >
                    </div>
                    <button type="submit" name="login">Login</button>
                </form>
                <div class="register-btn">
                    <a href="?page=register">Register</a>
                </div>
            </div>
        </div>

    </div>
</div>