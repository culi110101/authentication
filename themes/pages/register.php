<div class="register">
    <div class="register-form d-flex container">
        <div class="col-5 register-form__design">
            <div class="d-flex align-items-center">
                <div>
                    <img src="http://localhost/learn/Final_Project/assets/imgs/vertical_logo.png" alt="">
                    <h2>Thiết kế web chuyển SEO</h2>
                    <p>Dẫn đầu công nghệ</p>
                    LPtech dẫn đầu trong lĩnh vực SEO và Digital Marketing vơí hơn 10 năm kinh nghiệm và đội ngũ nhân viên chuyên nghiệp đào tạo chuyên sâu
                </div>
            </div>
        </div>
        <div class="col-7 register-form__content">
            <h1>Register</h1>
            <?php if (isset($_COOKIE["register_error"])) : ?>
                <div class="error-message">
                    <p><?= $_COOKIE["register_error"] ?></p>
                </div>
            <?php endif ?>
            <form action="?page=register&action=register" method="POST" id="register-form">
                <div>
                    <input type="text" name="account_name" placeholder="Account_name">
                </div>
                <div>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div>
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div>
                    <input type="text" name="phonenumber" placeholder="Phonenumber">
                </div>
                <div>
                    <input type="text" name="address" placeholder="Address">
                </div>
                <div>
                    <input id="register_password" type="password" name="password" placeholder="Password">
                </div>
                <div>
                    <input type="password" name="confirmpassword" placeholder="Confirmpassword">
                </div>
                <button type="submit" name="register" class="register-btn">Đăng ký</button>
            </form>
            <div class="cancel">
                <a href="?page=login">Cancel</a>
            </div>
        </div>
    </div>
</div>