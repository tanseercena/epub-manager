<?php

abstract class BaseModel {

    private $connection;

    private $query;

    private $table;

    private $primary_key;

    private $data;

    private $exists;

    public function __construct(){
        $this->setConnection();
        $this->setTable();
        $this->query = new Query($this->connection,$this->getTable());
        $this->exists = false;
    }

    public function setConnection(){
        $this->connection = Database::getInstance()->getConnection();
    }

    public function getConnection(){
        return $this->connection;
    }

    public function setTable(){
        if(empty($this->table)){
            $this->table = Helper::snake(Helper::pluralize(get_class($this)));
        }
    }


    public function getTable(){
        return $this->table;
    }

    public function insert($data = ''){
        return $this->query->insert($data);
    }

    public function update($data = []){
        $updated = false;
        if($this->exists){
            $updated = $this->query->update($this->data['id'],$data);
            $this->data = $this->query->find($this->data['id']);
        }
        return $updated;
    }

    public function delete(){
        if($this->exists){
         return $this->query->delete($this->data['id']);
        }
        return false;
    }

    public function find($id){
        $this->data = $this->query->find($id);
        if($this->data){
            $this->exists = true;
        }
    }

    public function all($columns = ['*']){
        return $this->query->all($columns);
    }

    public function where($column, $value ,$operator = '='){
        $this->query->where($column,$value,$operator);
        return $this;
    }

    public function orWhere($column, $value ,$operator = '='){
        $this->query->where($column,$value,$operator,'OR');
        return $this;
    }

    public function first(){
        return $this->query->first();
    }

    public function get(){
        return $this->query->get();
    }

    public function getSql(){
        return $this->query->getSql();
    }

    public function __get($column){
        // $this->data = array(
        //     'id' => 1,
        //     'name' => 'Tanser'
        // )
        if(isset($this->data[$column])){
            return $this->data[$column];
        }

    }
    
    public function orderBy($col = 'id', $order = 'ASC'){
        $this->query->orderBy($col,$order);
        return $this;
    }

}
