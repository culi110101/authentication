<div class="home">
    <div>
        <div class = "information_form p-5" >
            <img src="http://localhost/learn/Final_Project/assets/imgs/logo.svg" alt="">
            <h1>Xin chào <span> <?= $data->info['name']?> </span> !</h1>
            <p>Đây là thông tin của bạn: </p>
            <div>
                <p>Họ và Tên: <?=$data->info['name']?></p>
                <p>Số điện thoại: <?=$data->info['phone_number']?></p>
                <p>Địa chỉ: <?=$data->info['address']?></p>
                <div class="block_handle mb-3">
                    <a href="?page=updateinfor" class="update_infor">Thay đổi thông tin</a>
                    <a href="?action=logout" class="logout">Logout</a>
                </div>
                <a href="?page=add_article" class="logout">add article</a>
            </div>
        </div>
    </div>
</div>