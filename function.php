<?php

function ddd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die;

}
function login()
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
        $querry_result = querySellect(["BIN_TO_UUID(id) id", "account_name", "password"], "dbtest.account", ["account_name" => "'" . $username . "'"]);
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
        // mysqli_close(dbconecttor());
        die();
    }
}
function logout()
{
    $session = getSession('account_id');
    if ($session) {
        unset($_SESSION['account_id']);
    }
    header("Location: /learn/Final_Project/");
}
function register()
{
    if (isset($_POST['register'])) {
        //Lấy dữ liệu nhập vào
        $accountname = addslashes($_POST['accountname']);
        $password = addslashes($_POST['password']);
        $confirmpassword = addslashes($_POST['confirmpassword']);
        $username = addslashes($_POST['username']);
        $phonenumber = addslashes($_POST['phonenumber']);
        $address = addslashes($_POST['address']);
        if (!$accountname || !$password || !$confirmpassword || !$username || !$phonenumber || !$address) {
            echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        // mã hóa pasword
        $password = md5($password);
        // Kiểm tra tên đăng nhập có tồn tại không
        $row = querySellect(["BIN_TO_UUID(id) id", "account_name", "password"], "dbtest.account", ["account_name" => "'" . $accountname . "'"]); // tạo ra phần tử của mảng có dạng key bằng account_name  và value bằng 'giá trị của $account_name'
        if ($row) {
            echo "Tên đăng nhập này đã tồn tại. Vui lòng chọn tên tài khoản khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        //tạo tài khoản mới   
        queryInsert(['UUID_TO_BIN(UUID())', "'" . $accountname . "'", "'" . $password . "'"], ['dbtest.account (id, account_name, password)']);
        //thêm thông tin người dung vào tài khoản đã đăng kí
        $account_id = querySellect(['BIN_TO_UUID(id) id', 'account_name', 'password'], 'dbtest.account', ['account_name' => "'" . $accountname . "'"])[0];
        queryInsert(['UUID_TO_BIN(UUID())', "UUID_TO_BIN('" . $account_id . "')", "'" . $username . "'", "'" . $phonenumber . "'", "'" . $address . "'"], ['dbtest.user_information (id, account_id, name,phone_number,address)']);
    }
}
function getInforById()
{
    $idforfind = getSession('account_id');
    return $row = querySellect(["BIN_TO_UUID(dbtest.account.id) id", "dbtest.account.account_name", "dbtest.user_information.name", "dbtest.user_information.phone_number", "dbtest.user_information.address"], "dbtest.account INNER JOIN dbtest.user_information
    ON dbtest.account.id = dbtest.user_information.account_id", ["dbtest.user_information.account_id" => "UUID_TO_BIN('$idforfind')"]);
}
function updateInfor()
{
    if (isset($_POST['updateinfor'])) {
        $username = addslashes($_POST['username']);
        $phonenumber = addslashes($_POST['phonenumber']);
        $address = addslashes($_POST['address']);
        $idforfind = getSession('account_id');
        if (!$username || !$phonenumber || !$address) {
            echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
        }
        //thêm thông tin người dung vào tài khoản đã đăng kí
        queryUpdate(['name' => "'" . $username . "'", 'phone_number' => "'" . $phonenumber . "'", 'address' => "'" . $address . "'"], "dbtest.user_information", ['account_id' => "UUID_TO_BIN('" . $idforfind . "')"]);
    }
}
function getSession($key = null)
{
    if ($key || isset($_SESSION["$key"]))
        return $_SESSION["$key"];
    return false;
}
function setSession($key = null, $value = null)
{
    if ($key || $value) {
        $_SESSION["$key"] = $value;
        return true;
    }
    return false;
}
function querySellect($value = [], $table = null, $where = [])
{
    if ($table && $where && $value) {
        $sql = "SELECT ";
        foreach ($value as $value) {
            $sql .= "{$value}, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " FROM {$table} WHERE ";

        foreach ($where as $key => $value) {
            $sql .= "{$key} = {$value} AND ";
        }
        $sql = substr($sql, 0, -4);
        // $query = mysqli_query(dbconecttor(), $sql);
        $row = mysqli_fetch_array($query);
        return $row;
    }
}
function queryInsert($value = [], $where = [])
{
    if ($where && $value) {
        $sql = "INSERT INTO ";
        foreach ($where as $where) {
            $sql .= "{$where}, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= " VALUES (";
        foreach ($value as $value) {
            $sql .= "{$value}, ";
        }
        $sql = substr($sql, 0, -2);
        $sql .= ")";
        // mysqli_query(dbconecttor(), $sql);
        return $sql;
    }
}
function queryUpdate($value = [], $table = null, $where = [])
{
    $sql = "UPDATE {$table} SET ";
    foreach ($value as $key => $value) {
        $sql .= "{$table}.{$key}={$value}, ";
    }
    $sql = substr($sql, 0, -2);
    $sql .= " WHERE ";
    foreach ($where as $key => $where) {
        $sql .= "{$table}.{$key}={$where} AND ";
    }
    $sql = substr($sql, 0, -4);
    // mysqli_query(dbconecttor(), $sql);
}
