<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;
use Code\Entity\Product;

class ProductController 
{
    public function index($id)
    {

        $id = (int) $id;
      
        //preciso para na instanciação desta classe um parâmetro que 
       //é a conexão PDO
       $pdo = Connection::getInstance();

       $view = new View('site/single.phtml');
       
       $product = new Product($pdo);
       $view->product = $product->find($id);      
        
       return $view->render(); 
    }
}



?>