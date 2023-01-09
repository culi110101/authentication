<?php

class Controller 
{
    public $model = null;
    public function __construct()
    {
        $this->model = new Model();
    }

    private function render($view_name, $data) 
    {
        $data = (Object) $data;
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
        $this->__checkLogin();
        $info = $this->model->getInforById();
        $this->render('home', ['info' => $info]);
    }

    public function login()
    {
        $this->render('login', []);
    }

    public function postLogin()
    {
        ddd($this->model->login());
    }

    public function register()
    {
        $this->__checkLogin('register');
        $this->render('register', []);
    }


    protected function  __checkLogin($redirect_to = 'login')
    {
        if (!getSession('account_id')) {
            header("Location: ?page={$redirect_to}");
        }
    }


}