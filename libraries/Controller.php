<?php

class Controller
{
    public $model = null;
    public function __construct()
    {
        $this->model = new Model();
    }
    // render giao diện theo view-name, lấy dữ liệu và lưu vào biến data
    private function render($view_name, $data)
    {
        $data = (object) $data;
        // lưu đường dẫn các file styles và script
        $style = 'themes/partials/styles.php';
        $script = 'themes/partials/script.php';
        //convert pages to file_name
        $file_name = $view_name . '.php';
        //convert file_name to file_path
        $file_path = 'themes/pages/' . $file_name;
        require_once 'themes/layout.php';
    }

    public function home()
    {
        if (!$this->__checkLogin()) {
            header("Location: ?page=login");
        }
        $info = $this->model->getInforById()[0];
        $this->render('home', ['info' => $info]);
    }
    // render login form
    public function login()
    {
        if (!$this->__checkLogin()) {
            $this->render('login', []);
        } else {
            header("Location: ?page=home");
        }
    }
    // run login method
    public function postLogin()
    {
        $this->model->login();
    }
    // render register form
    public function register()
    {
        if (!$this->__checkLogin()) {
            $this->render('register', []);
        } else {
            header("Location: ?page=home");
        }
    }
    // run register method
    public function postRegister()
    {
        $this->model->register();
        // header("Location: ?page=home");
    }
    // run register logout
    public function postLogout()
    {
        $this->model->logout();
    }
    // render updateinfor form
    public function updateinfor()
    {
        $info = $this->model->getInforById()[0];
        $this->render('updateinfor', ['info' => $info]);
    }
    // run updateinfor logout
    public function postupdateinfor()
    {
        $this->model->updateinfor();
        $info = $this->model->getInforById()[0];
        $this->render('updateinfor', ['info' => $info]);
    }
    // kiểm tra người dùng đã đăng nhập hay chưa
    protected function  __checkLogin()
    {
        if (getSession('account_id')) {
            return true;
        }
        return false;
    }

    public function add_article()
    {
        $this->render('add_article', []);
    }

    public function postAddArticle()
    {
        $this->model->addArticle();
    }
    
    public function article_detail()
    {
        $info = $this->model->getArticleById();
        $this->render('article_detail', ['info' => $info]);
    }
    public function article_category()
    {
        $info = $this->model->getAllArticle();
        $this->render('article_category', ['info' => $info]);
    }
}

