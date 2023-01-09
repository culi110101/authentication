<div class="register">
    <div class="register-form">
        <img src="http://localhost/learn/Final_Project/assets/imgs/logo.svg" alt="">
        <h1>Đăng ký tài khoản</h1>
        <form action="?page=register&action=register" method="POST">
            <div>
                <label for="accountname">Tên đăng nhập</label>
                <input type="text" name="accountname" required oninput="checkName(this)" id="register-name">
            </div>
            <div>
                <label for="username">Họ và tên</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="phonenumber">Số điện thoại</label>
                <input type="text" name="phonenumber" required oninput="checkPhone(this)" id="register-phonenumber">
            </div>
            <div>
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" required>
            </div>
            <div>
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" required oninput="checkPassword(this)" id="register-password">
            </div>
            <div>
                <label for="confirmpassword">Nhập lại mật khẩu</label>
                <input type="password" name="confirmpassword" oninput="checkConfirmPassword(this)" id="register-confirmpassword" required>
            </div>
            <button type="submit" name="register" class="register-btn">Đăng ký</button>
        </form>
        <div class="cancel">
            <a href="?page=login">Cancel</a>
        </div>
    </div>
</div>