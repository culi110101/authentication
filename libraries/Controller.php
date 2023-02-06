<?php

class Controller
{
    public $model, $view = null;
    public function __construct()
    {
        $this->model = new Model();
        $this->view = new View;
    }

    public function home()
    {
        if (!$this->__checkLogin()) {
            header("Location: login");
        }
        $info = $this->model->getInforById()[0];
        $this->view->render('pages/home', ['info' => $info]);
    }
    // render login form
    public function login()
    {
        isset($_COOKIE["login_error"]) ? $error = $_COOKIE["login_error"] : $error = null;
        if (!$this->__checkLogin()) {
            $this->view->render('pages/login', ['isset' => isset($_COOKIE["login_error"]), 'val' => $error]);
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
        isset($_COOKIE["register_error"]) ? $error = $_COOKIE["register_error"] : $error = null;
        if (!$this->__checkLogin()) {
            $this->view->render('pages/register', ['isset' => isset($_COOKIE["register_error"]), 'val' => $error]);
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
    // run logout
    public function logout()
    {
        $this->model->logout();
    }
    // render updateinfor form
    public function updateinfor()
    {
        $info = $this->model->getInforById()[0];
        $this->view->render('pages/updateinfor', ['info' => $info]);
    }
    // run updateinfor logout
    public function postupdateinfor()
    {
        $this->model->updateinfor();
        $info = $this->model->getInforById()[0];
        $this->view->render('pages/updateinfor', ['info' => $info]);
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
        $this->view->render('pages/add_article');
    }

    public function postAddArticle()
    {
        $this->model->addArticle();
    }

    public function article_detail($slug)
    {
        $info = $this->model->getArticleById($slug)[0];
        $this->view->render('pages/article_detail', ['data' => $info]);
    }
    public function article_category()
    {
        $info = $this->model->getAllArticle();
        $this->view->render('pages/article_category', ['items' => $info]);
    }
    public function verify()
    {
        $this->view->render('pages/verify');
    }
}
