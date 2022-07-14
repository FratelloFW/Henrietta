<?php
namespace Henrietta\Database;

use Henrietta\Database\DataWorker;

class Chunk extends DataWorker{

    public static function table(string $table){
        $me = new static();
        $me->table = $table;

        return $me;
    }

    public static function create_table(){
        //TODO
    }

    public static function create_database(){
        //TODO
    }

    public static function raw_sql($SQL, $params){
        //TODO
    }

    public function __construct(){
        $this->PDO = $this->NewPDO();

        return $this;
    }

    public function column(array $col = ['*']){
        if(count($col) === 0){
            $this->col = ['*'];
        }else{
            $this->col = $col;
        }

        return $this;
    }

    public function select(){
        $this->type = 'SELECT';

        return $this;
    }

    public function insert(){
        $this->type = 'INSERT INTO';

        return $this;
    }

    public function update(){
        $this->type = 'UPDATE';

        return $this;
    }

    public function delete(){
        $this->type = 'DELETE';

        return $this;
    }

    public function logical_delete(){
        $this_type = 'LOGICAL_DEL';

        return $this;
    }

    public function where(...$where){
        $this->where = $where;

        return $this;
    }

    public function set(array $key_value){
        $this->set_data = $key_value;

        return $this;
    }

    public function join(string $table2, string $table2_std_column, string $table1_std_column){
        $this->join_data['table2'] = $table2;
        $this->join_data['table2_std'] = $table2_std_column;
        $this->join_data['table1_std'] = $table1_std_column;
        
        return $this;
    }

    public function group_by(...$colname){
        $this->group_by = $colname;

        return $this;
    }

    public function order_by(array $order_type){
        $this->order_by = $order_type;

        return $this;
    }

    public function gather(){
        //TODO
    }

    public function pull(){
        //TODO
    }

    public function catch(){
        //TODO
    }

    public function reap(){
        //TODO
    }

    public function get_subquery(){
        return self::$SubQuery;
    }

    public function is_in(){
        //TODO
    }

    public function is_not_in(){
        //TODO
    }

    public function sum(){
        //TODO
    }

    public function max(){
        //TODO
    }

    public function mean(){
        //TODO
    }

    public function last_insert_id(){
        //TODO
    }

    public function sub_query(){
        $this->prepare();
        $this->ToSubQuery();

        return $this;
    }

    private function prepare(){
        $this->SQLBuilder();
        
        return $this;
    }
}