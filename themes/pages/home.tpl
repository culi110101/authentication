{% extends 'layout.tpl' %}
{% block body %}
<div class="home">
    <div>
        <div class = "information_form p-5" >
            <img src="http://localhost/learn/Final_Project/assets/imgs/logo.svg" alt="">
            <h1>Xin chào <span> {{info.name}} </span> !</h1>
            <p>Đây là thông tin của bạn: </p>
            <div>
                <p>Họ và Tên: {{info.name}}</p>
                <p>Số điện thoại: {{info.phone_number}}</p>
                <p>Địa chỉ: {{info.address}}</p>
                <div class="block_handle mb-3">
                    <a href="updateinfor" class="update_infor">Thay đổi thông tin</a>
                    <a href="logout" class="logout">Logout</a>
                </div>
                <a href="add_article" class="logout">add article</a>
            </div>
        </div>
    </div>
</div>
{% endblock %}