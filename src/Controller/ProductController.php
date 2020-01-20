<?php

namespace Code\Controller;

use Code\DB\Connection;
use Code\View\View;
use Code\Entity\Product;

class ProductController 
{
    public function index($id)
    {

      //  $id = (int) $id;
      
        //preciso para na instanciação desta classe um parâmetro que 
       //é a conexão PDO
       $pdo = Connection::getInstance();

  //     var_dump((new Product($pdo))->where(
  //      ['category_id' => 2]
//    ));
  //  var_dump((new Product($pdo))->findAll());
  //  var_dump((new Product($pdo))->update(
 //       ['id' => 12, 'name' => 'Teste2', 'price' => 29.99, 'amount'=>11, 'description' => 'Teste', 'slug' => 'slug']
  //  ));
  echo '<pre>';
  var_dump((new Product($pdo))->findAll());
  echo '</pre>';
  var_dump((new Product($pdo))->delete(12));


      // $view = new View('site/single.phtml');
   //   var_dump((new Product($pdo))->insert(
   //         ['name' => 'Teste', 'price' => 19.99, 'amount'=>10, 'description' => 'Teste', 'slug' => 'slug']
   //     ));

       
    //   $product = new Product($pdo);
     //  $view->product = $product->find($id);      
        
     //  return $view->render(); 
    }
}



?>