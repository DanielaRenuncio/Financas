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

   public function find(int $id, $fields = '*')
   {
      return current($this->where(['id' => $id], '', $fields));
       
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

     //$get = $this->conn->prepare($sql);
     
     $get = $this->bind($sql, $conditions);
     $get->execute();
    return $get->fetchAll(\PDO::FETCH_ASSOC);
     
   }
 // *****************  INSERT **************************/
   public function insert($data)
   {
     $binds = array_keys($data);
     $fields = implode(', ', $binds);
     $sql = 'INSERT INTO ' . $this->table . '('.$fields .', created_at,updated_at
             ) VALUES(:'. implode(', :',$binds).', NOW(), NOW())';
    
     $insert = $this->conn->prepare($sql);
     $insert = $this->bind($sql, $data);

     return $insert->execute();
   }

   // *****************  UPDATE **************************/
   public function update($data): bool
	{
		if(!array_key_exists('id', $data)) {
			throw new \Exception('É preciso informar um ID válido para update!');
		}

		$sql = 'UPDATE ' . $this->table . ' SET ';

		$set = null;
		$binds = array_keys($data);

		foreach($binds as $v) {
			if($v !== 'id') {
				$set .= is_null($set) ? $v . ' = :' . $v : ', ' .  $v . ' = :' . $v ;
			}
		}
		$sql .= $set . ', updated_at = NOW() WHERE id = :id';

		$update = $this->bind($sql, $data);

		return $update->execute();
	}

   private function bind($sql, $data)
   {
    $bind = $this->conn->prepare($sql);
    foreach ($data as $k => $v){
      gettype($v) == 'int' ? $bind->bindValue(':' . $k,$v, \PDO::PARAM_INT) 
                           : $bind->bindValue(':' . $k,$v, \PDO::PARAM_STR) ;
    }
    return $bind;
   }
}

?>