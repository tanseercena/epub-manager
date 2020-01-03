<?php 

class Query {
    private $connection;
    
    private $table;

    private $wheres = [];

    private $sql;

    private $order_by = "";

    public function __construct($conn,$table = ''){
        $this->connection = $conn;
        $this->table = $table;
        $this->sql = '';
    }
    
    public function insert($data = ''){
        if(empty($data)){
            // Insert with default 
            // INSERT INTO users default values
            return true;
        }
        
        // INSERT INTO users(columns) VALUES(...)

        // Convert array keys to columns
        $columns = implode(",",array_keys($data));

        // Convert array values to insert values
        $values = "'".implode("', '",$data)."'";

        //Insert into DB
        $this->sql = "INSERT INTO ".$this->table."($columns) VALUES($values)";
        
        return mysqli_query($this->connection,$this->sql);
    }

    public function update($id,$data = '')
    {
        if(empty($data)){
            // Insert with default 
            // INSERT INTO users default values
            return true;
        }
        
        // Convert array keys to columns values
        $cols = array();
 
        foreach($data as $key=>$val) {
            $cols[] = "$key = '$val'";
        }
        
        //Update into DB
        $this->sql = "UPDATE ".$this->table." SET  ".implode(', ', $cols)." WHERE id=".$id;
        
        return mysqli_query($this->connection,$this->sql);
    }

    public function find($id){
        // SELECT * FROM table WHERE id= $id 
        $this->sql = "SELECT * FROM ".$this->table." WHERE id=$id";
        
        $result = mysqli_query($this->connection,$this->sql);
        if(mysqli_num_rows($result) > 0){
            return mysqli_fetch_array($result);
        }
        return false;
    }
    
    public function delete($id){
        $this->sql = "DELETE FROM " .$this->table." WHERE id =" .$id;
        return mysqli_query($this->connection,$this->sql);
    }

    public function all($columns){
        $columns = "`".implode("`, `",$columns)."`";

        $columns = ($columns == '`*`') ? '*' : $columns;

        $this->sql = "SELECT ".$columns." FROM ".$this->table. $this->order_by;

        $result = mysqli_query($this->connection,$this->sql);

        $records = [];

        while($row = mysqli_fetch_array($result)){
            $records[] = $row;
        }
        
        return $records;
    }

    public function where($column, $value ,$operator = '=',$cond = 'AND'){
        $this->wheres[$cond][] = [
            $column => ['val'=>$value,'op'=>$operator]
        ];
        return $this;
    }

    public function getWhereClause(){
        // foreach($this->wheres as $where){
        //     foreach($where as $col => $val_op){
        //         $where_clause .= ' OR `'.$col.'`'.$val_op['op']."'".$val_op['val']."' ";
        //     }
        // }
        $where_arr = [];
        $where_clause = '';
        if(isset($this->wheres['AND'])){
            foreach($this->wheres['AND'] as $where){
                $where_c = array_map(function($val_op,$col){
                    return "`".$col."`".$val_op['op']."'".$val_op['val']."'";
                    },$where,array_keys($where));
                $where_arr = array_merge($where_arr,$where_c);
            }
        }
            
        $where_clause .=  implode(' AND ',$where_arr);

        $where_arr = [];
        $where_clause_or = '';
        if(isset($this->wheres['OR']))
            foreach($this->wheres['OR'] as $where){
                $where_c = array_map(function($val_op,$col){
                    return "`".$col."`".$val_op['op']."'".$val_op['val']."'";
                    },$where,array_keys($where));
                $where_arr = array_merge($where_arr,$where_c);
            }
        $where_clause_or .=  implode(' OR ',$where_arr);

        $final_where = '';
        if(!empty($where_clause)){
            $final_where .= '('.$where_clause.')';
        }
        if(!empty($where_clause) && !empty($where_clause_or)){
            $final_where .=' OR ';
        }
        if(!empty($where_clause_or)){
            $final_where .= ' ('.$where_clause_or.')';
        }

        return !empty($final_where) ? 'WHERE '.$final_where : 'WHERE 1';
    }

    public function first(){
        //SELECT * FROM users WHERE id>1 AND name='test' AND status!=1 
        $where_clause = $this->getWhereClause();
        
        $this->sql = "SELECT * FROM ".$this->table." ".$where_clause. $this->order_by;

        $result = mysqli_query($this->connection,$this->sql);
        if(mysqli_num_rows($result) > 0){
            return mysqli_fetch_array($result);
        }
        return false;

        // $new = array_map(function($param1,$parm1){
        //     return 
        // },$arr1,$arr2);

        
    }

    public function get(){
        $where_clause = $this->getWhereClause();
        
        $this->sql = "SELECT * FROM ".$this->table." ".$where_clause. $this->order_by;

        $result = mysqli_query($this->connection,$this->sql);

        $records = [];

        while($row = mysqli_fetch_array($result)){
            $records[] = $row;
        }
        
        return $records;
    }

    public function orderBy($col, $order){
        $this->order_by = " ORDER BY `$col` $order ";
    }

    public function getSql(){
        return $this->sql;
    }
}