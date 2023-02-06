{% extends 'layout.tpl' %}
{% block body %}
<div class="updatainfor">
    <div class="updatainfor-form">
        <img src="http://localhost/learn/Final_Project/assets/imgs/logo.svg" alt="">
        <h1>Cập nhập thông tin cá nhân</h1>
        <form action="updateinfor" method="POST">
            <div>
                <label for="username">Họ và tên</label>
                <input type="text" name="username" value="{{info.name}}">
                <i class="lp-check namecorrect correct"></i>
                <i class="lp-close nameincorrect incorrect"></i>
            </div>
            <div>
                <label for="phonenumber">Số điện thoại</label>
                <input type="text" name="phonenumber" value="{{info.phone_number}}">
                <i class="lp-check correct phonecorrect"></i>
                <i class="lp-close incorrect phoneincorrect"></i>
            </div>
            <div>
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" value="{{info.address}}">
            </div>
            <button type="submit" name="updateinfor" class="updateinfor-btn">Cập nhập</button>
        </form>
        <div class="cancel">
            <a href="home">Cancel</a>
        </div>
    </div>
</div>
{% endblock %}