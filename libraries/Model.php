<?php
require_once 'Database.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Model extends Database
{
    public $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }
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
    public function getArticleById($slug)
    {
        $row = $this->querySellect(["dbauthentication.article.title", "dbauthentication.article.intro", "dbauthentication.article.content","dbauthentication.article.avatar_url"], "dbauthentication.article", ["dbauthentication.article.slug" => "'$slug'"]);
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
            // Lấy dữ liệu nhập vào
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
            //tạo tài khoản mới   
            // $this->queryInsert(['UUID_TO_BIN(UUID())', "'$accountname'", "'$email'", "'$password'"], ['dbauthentication.account (id, accountname, email, password)']);
            // $this->queryInsert(['UUID_TO_BIN(UUID())', "'$accountname'", "'$email'", "'$password'", "'$verified_code'", "'$created'"], ['dbauthentication.account (id, accountname, email, password,verified_code,created)']);
            try {
                //Server settings
                $this->mail->isSMTP();                                            //Send using SMTP
                $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $this->mail->Username   = 'xuanbuidemoemail@gmail.com';                     //SMTP username
                $this->mail->Password   = 'csickxixdjfwffdk';                               //SMTP password
                $this->mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
                $this->mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                
                //Recipients
                $this->mail->setFrom('from@example.com', 'Mailer');
                $this->mail->addAddress('buidinhxuanit@gmail.com', 'Joe User');     //Add a recipient
                // $this->mail->addAddress('ellen@example.com');               //Name is optional
                $this->mail->addReplyTo('info@example.com', 'Information');
                $this->mail->addCC('cc@example.com');
                $this->mail->addBCC('bcc@example.com');
                
                // //Attachments
                // $this->mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
                
                //Content
                $this->mail->isHTML(true);                                  //Set email format to HTML
                $this->mail->Subject = 'Verify your account 2';
                $this->mail->Body    = '<a href="http://localhost/learn/Final_Project/verify">click here</a> to verify your account';
                $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                
                // ddd($this->mail);
                $this->mail->send();
                echo("tài khoản đã được tạo thành công");
                die();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}";
                die();
            }
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
            $slug=to_slug($title);
        }
        $this->queryInsert(["'$title'", "'$intro'", "'$content'","'$slug'","'$img'"], ['dbauthentication.article (title, intro, content, slug, avatar_url)']);
    }
}
