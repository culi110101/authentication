<?php
$route->any(['/', 'home'], 'Controller@home');
$route->get('/login', 'Controller@login');
$route->post('/login', 'Controller@postLogin');
$route->any('/logout', 'Controller@logout');
$route->get('/updateinfor', 'Controller@updateinfor');
$route->post('/updateinfor', 'Controller@postupdateinfor');
$route->get('/article', 'Controller@article_category');
$route->get('/article/?', 'Controller@article_detail');
$route->get('/add_article', 'Controller@add_article');
$route->post('/add_article', 'Controller@postAddArticle');
$route->get('/register', 'Controller@register');
$route->post('/register', 'Controller@postregister');
$route->get('/verify', 'Controller@verify');



