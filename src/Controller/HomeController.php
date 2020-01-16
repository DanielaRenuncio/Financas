<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;
use Code\Entity\Product;

class HomeController 
{
    public function index()
    {
       //preciso para na instanciação desta classe um parâmetro que 
       //é a conexão PDO
       $pdo = Connection::getInstance();
        $products = new Product($pdo);
       // var_dump($products->findAll());die;
        $view = new View('site/index.phtml'); 
        //estou mandando os produtos para a view
        $view->products = $products->findAll();
        return $view->render();
    }
}



?>