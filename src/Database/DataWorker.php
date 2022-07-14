<?php
namespace Henrietta\Database;

class DataWorker{
    protected $table;
    protected $PDO;
    protected $col;
    protected $type;
    protected $where;
    protected $set_data;
    protected $join_data;
    protected $group_by;
    protected $order_by;
    protected $SQL;
    protected static $SubQuery;

    protected function NewPDO(){
        $dbtype = 'mysql';
        $port = '3306';
        $host = '127.0.0.1';
        $user = 'root';
        $pass = '';
        $dsn = $dbtype.':host='.$host.';port='.$port;
        $errmode = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING];
        $pdo = new \PDO($dsn, $user, $pass, $errmode);
        $this->PDO = $pdo;
    }

    protected function SQLBuilder(){

    }

    protected function GetSubQuery(){

    }

    protected function ToSubQuery(){

    }
}