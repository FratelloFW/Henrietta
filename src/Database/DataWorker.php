<?php
namespace Henrietta\Database;

class DataWorker{
    protected $table;
    protected $PDO;
    protected $col;
    protected $type;
    protected $where;
    protected $where_data = [];
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
        $SQL = '';
        if($this->type === 'SELECT'){
            $SQL = $this->SelectBuilder();
        }
        
        $this->SQL = $SQL;
        
        return true;
    }

    protected function GetSubQuery(){

    }

    protected function ToSubQuery(){

    }

    protected function Execute(){
        $stmt = $this;
        if($this->type === 'SELECT'){
            $stmt = $this->PDO->prepare($this->SQL);
            $stmt->execute($this->where_data);
        }

        return $stmt;
    }

    private function SelectBuilder(){
        $SQL = 'SELECT ';

        foreach($this->col as $c){
            $SQL.= $c.', ';
        }
        $SQL = rtrim($SQL, ',');

        $SQL .= ' FROM '.$this->table;
        if(!is_null($this->where) && strlen($this->where) != 0){
            $SQL .= $this->where;
        }

        if(!is_null($this->join_data) && array_key_exists('table2', $this->join_data) && array_key_exists('table2_std', $this->join_data) && array_key_exists('table1_std', $this->join_data) && array_key_exists('type', $this->join_data)) {
            $SQL.= trim($this->join_data['type']).' '.trim($this->join_data['table2']).' ON '.trim($this->table).'.'.trim($this->join_data['table1_std']).' = '.trim($this->join_data['table2']).'.'.trim($this->join_data['table2_std']);
        }

        if(is_array($this->group_by)){
            $SQL .= 'GROUP BY ';
            foreach($this->group_by as $group_by){
                $SQL .= trim($group_by).' ,';
            }
            rtrim($SQL, ',');
        }

        if(is_array($this->order_by)){
            $SQL.= 'ORDER BY ';
            foreach($this->order_by as $col => $is){
                $SQL.= trim($col).' '.$is.', ';
            }
            rtrim($SQL, ',');
        }

        return $SQL;
    }
}