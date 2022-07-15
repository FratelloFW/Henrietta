<?php
namespace Fratello\Henrietta\Database;

use Henrietta\Database\DataWorker;

class Chunk extends DataWorker{

    public static function table(string $table){
        $me = new static();
        $me->table = $table;

        return $me;
    }

    public static function raw_sql(string $SQL, array $params = []){
        $stmt = $this->PDO->prepare($SQL);
        if(count($params) != 0){
            $stmt->execute($params);
        }else{
            $stmt->execute();
        }
        $this->stmt = $stmt;

        return $this;
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

    public function sum(string $set_col_name = 'SummedColumn'){
        array_push($this->col, 'SUM('.$set_col_name.')');

        return $this;
    }

    public function max(string $set_col_name = 'SummedColumn'){
        array_push($this->col, 'MAX('.$set_col_name.')');
        
        return $this;
    }

    public function min(string $set_col_name = 'SummedColumn'){
        array_push($this->col, 'MIN('.$set_col_name.')');

        return $this;
    }

    public function select(){
        $this->type = 'SELECT';

        return $this;
    }

    public function insert(){
        $this->type = 'INSERT';

        return $this;
    }

    public function update(){
        $this->type = 'UPDATE';

        return $this;
    }

    public function delete(int $limit = 0){
        $this->type = 'DELETE';
        $this->del_limit = $limit;

        return $this;
    }

    public function logical_delete(){
        $this_type = 'LOGICAL_DEL';

        return $this;
    }

    public function where($col, $is, $what){
        $this->where = ' WHERE '.trim($col).' = '.trim($is).' ?';
        array_push($this->where_data, $what);

        return $this;
    }

    public function or($col, $is, $what){
        $this->where = ' OR '.trim($col).' '.trim($is).' ?';
        array_push($this->where_data, $what);

        return $this;
    }

    public function and($col, $is, $what){
        $this->where = ' AND '.trim($col).' '.trim($is).' ?';
        array_push($this->where_data, $what);

        return $this;
    }

    public function set(array $key_value){
        $this->set_data = $key_value;

        return $this;
    }

    public function join(string $table2, string $table2_std_column, string $table1_std_column, string $type='LEFT OUTHER JOIN'){
        $this->join_data['table2'] = $table2;
        $this->join_data['table2_std'] = $table2_std_column;
        $this->join_data['table1_std'] = $table1_std_column;
        $this->join_data['type'] = $type;
        
        return $this;
    }

    public function group_by(...$colname){
        $this->group_by = $colname;

        return $this;
    }

    public function order_by(...$order_type){
        $this->order_by = $order_type;

        return $this;
    }

    public function raw_gather(){
        $this->stmt->fetchAll();
        
        return $this;
    }

    public function raw_pull(){
        $this->stmt->fetch();

        return $this;
    }

    public function gather(){
        $this->SQLBuilder();
        $this->Execute()->fetchAll();
        
        return $this;
    }

    public function pull(){
        $this->SQLBuilder();
        $this->Execute()->fetch();

        return $this;
    }

    public function catch(string $column){
        $this->col = [$column];
        $this->SQLBuilder();
        $this->Execute()->fetch();

        return $this;
    }

    public function reap(string $column){
        $this->col = [$column];
        $this->SQLBuilder();
        $this->Execute()->fetchAll();

        return $this;
    }

    public function perform(){
        $this->SQLBuilder();
        $this->Execute();

        return $this;
    }

    public function get_subquery(){
        return self::$SubQuery;
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

    public function is_in(){
        if($this->count_row() === 0){
            return false;
        }else{
            return true;
        }
    }

    public function is_not_in(){
        if($this->is_in()){
            return false;
        }else{
            return true;
        }
    }

    public function last_insert_id(){
        return $this->pdo->lastInsertId();
    }

    public function count_row(){
        return $this->stmt->rowCount();
    }
}