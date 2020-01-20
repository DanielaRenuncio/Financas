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
    //   $pdo = Connection::getInstance();
       
      
        $view = new View('site/index.phtml'); 
      
        return $view->render();
    }
}



?>