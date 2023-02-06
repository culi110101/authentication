<?php
//Khai báo sử dụng thư viện
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private $twig;
    function __construct()
    {
        //Khởi tạo đối tượng loader
        $loader = new FilesystemLoader(BASE_PATH . '/themes/');

        //Khởi tạo đối tượng twig environment
        $this->twig = new Environment($loader, ['debug' => true]);
        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    function render($view_name, $vars = [])
    {
        echo $this->twig->render($view_name . TEMPLATE_EXT, $vars);
        // require_once 'themes/layout.php';
    }
}
