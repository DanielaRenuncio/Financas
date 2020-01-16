<?php

namespace Code\DB;

class Connection 
{
    private static $instance = null;

    private function __construct()
    {
        
    }
    //quando estou no topo de um método static, eu não tenho acesso ao $this que referencia o objeto
    //para referenciar esta classe, uso a palavra reservada self, usando o operado de resolução
    //de escopo ::
    //por meio desta função static é que irei acessar aminha conexão com o banco
    public static function getInstance()
    {
        //aplicação do padrão Singleton para ter somente 1 instância da Conexão
        if (is_null(self::$instance)){
            self::$instance = new \PDO('mysql:dbname=formacao_php;host:127.0.0.1','root','maxfono');
            self::$instance->exec('SET NAMES UTF8');
        }

        return self::$instance;

    }
}