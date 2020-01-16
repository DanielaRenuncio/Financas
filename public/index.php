<?php
require __DIR__ . '/../bootstrap.php';

use Code\Controller\PageController;

//substr vai pegar a string ignorando a primeira / que vem em REQUEST_URI
$url = substr($_SERVER['REQUEST_URI'],1);
$url = explode("/", $url);


$controller = isset($url[0]) && $url[0] ? $url[0] : 'home';

$action = isset($url[1]) && $url[1] ? $url[1] : 'index';

$param = isset($url[2]) && $url[2] ? $url[2] : null;

//recebo o nome do controller que eu quero
//verifica se a class controller de fato existe ou não
if (!class_exists($controller = "Code\Controller\\".ucfirst($controller).'Controller'))
{
   print (new \Code\View\View('404.phtml'))->render();
   die;
}

if (!method_exists($controller,$action))
{
   $action = 'index';
   $param = $url[1];
}
//print 'controller default: ' . $controller;
//print '<br> Método default: ' . $action;
echo '<br>';


$response = call_user_func_array([new $controller, $action],[$param]);
print $response;

//$execute = new $controller();
//print $execute->index();