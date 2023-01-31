<?php
require_once 'Database.php';

class Model extends Database
{
    public function login()
    {
        //Xử lý đăng nhập
        if (isset($_POST['login'])) {


            //Lấy dữ liệu nhập vào
            $username = addslashes($_POST['accountname']);
            $password = addslashes($_POST['password']);

            // mã hóa pasword
            $password = md5($password);

            //Kiểm tra tên đăng nhập có tồn tại không
            $querry_result = $this->querySellect(["BIN_TO_UUID(id) id", "accountname", "password"], "dbauthentication.account", ["accountname" => "'$username'"]);
            is_null($querry_result) ? $row = [] : $row = $querry_result[0];
            // ddd(count($row));
            if (count($row) == 0) {
                header("Location: /learn/Final_Project/?page=login");
                setcookie('login_error', "Tên đang nhập hoặc mật khẩu không chính xác. </br> Vui lòng kiểm tra lại!", time() + 1, "/");
                exit;
            }

            //So sánh 2 mật khẩu có trùng khớp hay không
            if ($password != $row["password"]) {
                header("Location: /learn/Final_Project/?page=login");
                setcookie('login_error', "Tên đang nhập hoặc mật khẩu không chính xác. </br> Vui lòng kiểm tra lại!", time() + 1, "/");
                exit;
            }
            //Lưu tên đăng nhập
            setSession('account_id', $row['id']);
            header("Location: /learn/Final_Project/");
            die();
        }
    }

    public function getInforById()
    {
        $idforfind = getSession('account_id');
        $row = $this->querySellect(["dbauthentication.user_information.name", "dbauthentication.user_information.phone_number", "dbauthentication.user_information.address"], "dbauthentication.user_information", ["dbauthentication.user_information.account_id" => "UUID_TO_BIN('$idforfind')"]);
        return $row;
    }
    public function getArticleById()
    {
        $row = $this->querySellect(["dbauthentication.article.title", "dbauthentication.article.intro", "dbauthentication.article.content","dbauthentication.article.avatar_url"], "dbauthentication.article", ["dbauthentication.article.id" => 4]);
        return $row;
    }
    public function getAllArticle()
    {
        $row = $this->querySellect(["*"], "dbauthentication.article", []);
        return $row;
    }
    public function register()
    {
        if (isset($_POST['register'])) {
            //Lấy dữ liệu nhập vào
            $accountname = addslashes($_POST['account_name']);
            $email = addslashes($_POST['email']);
            $password = addslashes($_POST['password']);
            $created = date("Y-m-d");
            $verified_code = "";
            $username = addslashes($_POST['username']);
            $phonenumber = addslashes($_POST['phonenumber']);
            $address = addslashes($_POST['address']);

            // mã hóa pasword
            $password = md5($password);
            // Kiểm tra tên đăng nhập có tồn tại không
            $row = $this->querySellect(["*"], "dbauthentication.account", ["accountname" => "'$accountname'"]); // tạo ra phần tử của mảng có dạng key bằng accountname  và value bằng 'giá trị của $accountname'
            if ($row) {
                header("Location: /learn/Final_Project/?page=register");
                setcookie('register_error', "Tên đang nhập đã tồn tại. Vui lòng kiểm tra lại!", time() + 5, "/");
                exit();
            }
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            for ($i = 0; $i < 6; $i++) {
                $verified_code .= $characters[rand(0, $charactersLength - 1)];
            }
            $verified_code = md5($verified_code);
            // //tạo tài khoản mới   
            // // $this->queryInsert(['UUID_TO_BIN(UUID())', "'$accountname'", "'$email'", "'$password'"], ['dbauthentication.account (id, accountname, email, password)']);
            // $this->queryInsert(['UUID_TO_BIN(UUID())', "'$accountname'", "'$email'", "'$password'", "'$verified_code'", "'$created'"], ['dbauthentication.account (id, accountname, email, password,verified_code,created)']);


            $verificationLink = "http://example.com/activate.php?code=" . $verified_code;

            $htmlStr = "";
            $htmlStr .= "Hi " . $email . ",<br /><br />";

            $htmlStr .= "Please click the button below to verify your subscription and have access to the download center.<br /><br /><br />";
            $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";

            $htmlStr .= "Kind regards,<br />";
            $htmlStr .= "<a href='https://www.hoangweb.com/' target='_blank'>Dịch vụ thiết kế web giá rẻ</a><br />";


            $name = "Hoangweb.com";
            $email_sender = "buidinhxuanit@gmail.com";
            $subject = "Verification Link | Thiết kế web giá rẻ | Subscription";
            $recipient_email = $email;

            $headers  = "MIME-Version: 1.0rn";
            $headers .= "Content-type: text/html; charset=iso-8859-1rn";
            $headers .= "From: {$name} <{$email_sender}> n";

            $body = $htmlStr;

            // send email using the mail function, you can also use php mailer library if you want
            if (mail($recipient_email, $subject, $body, $headers)) {

                // tell the user a verification email were sent
                var_dump("yes");
                die();
            } else {
                var_dump("no");
                die();
            }
            // //thêm thông tin người dung vào tài khoản đã đăng kí
            // $account_id = $this->querySellect(['BIN_TO_UUID(id) id', 'accountname', 'password'], 'dbauthentication.account', ['accountname' => "'$accountname'"])[0];
            // $this->queryInsert(['UUID_TO_BIN(UUID())', "UUID_TO_BIN('$account_id')", "'$username'", "'$phonenumber'", "'$address'"], ['dbauthentication.user_information (id, account_id, name,phone_number,address)']);
        }
    }
    public function updateinfor()
    {
        if (isset($_POST['updateinfor'])) {
            $username = addslashes($_POST['username']);
            $phonenumber = addslashes($_POST['phonenumber']);
            $address = addslashes($_POST['address']);
            $idforfind = getSession('account_id');

            //thêm thông tin người dung vào tài khoản đã đăng kí
            $this->queryUpdate(['name' => "'$username'", 'phone_number' => "'$phonenumber'", 'address' => "'$address'"], "dbauthentication.user_information", ['account_id' => "UUID_TO_BIN('$idforfind')"]);
        }
    }
    public function logout()
    {
        $session = getSession('account_id');
        if ($session) {
            unset($_SESSION['account_id']);
        }
        header("Location: /learn/Final_Project/");
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function addArticle()
    {
        if (isset($_POST['addArticle'])) {
            $title = addslashes($_POST['title']);
            $intro = addslashes($_POST['intro']);
            $content = addslashes($_POST['content']);
            $img = 'http://localhost/learn/Final_Project/assets/imgs/'.addslashes($_POST['img']).'.jpg';
        }
        $this->queryInsert(["'$title'", "'$intro'", "'$content'","'demo-slug'","'$img'"], ['dbauthentication.article (title, intro, content, slug, avatar_url)']);
    }
}
