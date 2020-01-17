<?php

namespace Code\DB;

use \PDO;

abstract class Entity
{

   private $conn; 
   //o filho que instanciar esta classe é que vai definir o nome da tabela
   protected $table;

   public function __construct(\PDO $conn)
   { 
     $this->conn = $conn;
   }

   public function findAll($fields = '*')
   {
       $sql = 'SELECT ' . $fields . ' FROM ' . $this->table;
       $get = $this->conn->query($sql);
       return $get->fetchAll(PDO::FETCH_ASSOC);
   }

   public function find(int $id)
   {
       $sql = 'SELECT * FROM products WHERE id = :id';
       $get = $this->conn->prepare($sql);
       $get->bindValue(':id', $id, \PDO::PARAM_INT);
       $get->execute();
       //$get->rowCount(); //se quiser fazer a verificação se voltou algo
       return $get->fetch(PDO::FETCH_ASSOC);
       
   }

   public function where(array $conditions, $operator= ' AND ', $fields = '*')
   {
     $sql = 'SELECT '. $fields . ' FROM ' . $this->table . ' WHERE ';
     $binds = array_keys($conditions);

     $where = null;
     foreach ($binds as $v){
         if (is_null($where)){
           $where .= $v . ' =:' . $v;
         }else {
          $where .= $operator . $v . ' =:' . $v;
         }
     }
     $sql .= $where;

     $get = $this->conn->prepare($sql);
     

     foreach ($conditions as $k => $v){
       gettype($v) == 'int' ? $get->bind(':' . $k,$v, \PDO::PARAM_INT) 
                            : $get->bind(':' . $k,$v, \PDO::PARAM_STR) ;
     }
     
     $get->execute();
     return $get->fetchAll(\PDO::FETCH_ASSOC);
     
   }
}

?>