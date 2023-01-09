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
            //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
            if (!$username || !$password) {
                echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
                exit;
            }

            // mã hóa pasword
            $password = md5($password);

            //Kiểm tra tên đăng nhập có tồn tại không
            $querry_result = $this->querySellect(["BIN_TO_UUID(id) id", "account_name", "password"], "dbtest.account", ["account_name" => "'" . $username . "'"]);
            is_null($querry_result) ? $row = [] : $row = $querry_result;
            if (count($row) == 0) {
                header("Location: /learn/Final_Project/?page=login");
                setcookie('accountname_error', "Tên đang nhập không tồn tại. Vui lòng kiểm tra lại!", time() + 1, "/");
                exit;
            }

            //So sánh 2 mật khẩu có trùng khớp hay không
            if ($password != $row['password']) {
                header("Location: /learn/Final_Project/?page=login");
                setcookie('password_error', "Mật khẩu không đúng. Vui lòng nhập lại!", time() + 1, "/");
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
        $row = $this->querySellect(["BIN_TO_UUID(dbtest.account.id) id", "dbtest.account.account_name", "dbtest.user_information.name", "dbtest.user_information.phone_number", "dbtest.user_information.address"], "dbtest.account INNER JOIN dbtest.user_information
        ON dbtest.account.id = dbtest.user_information.account_id", ["dbtest.user_information.account_id" => "UUID_TO_BIN('$idforfind')"]);
        return $row;
    }
}