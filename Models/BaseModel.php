<?php
require_once('Database/DBConnection.php');
class BaseModel extends DBConnection {
    public function __construct() {
        parent::connect();
    }
    
    // get data
    public function getData($query) {
        $result = $this->connection->query($query);
        
        if($result == false){
            return false;
        }
        $rows = array();
        $row = array();
        while($row = $result->fetch_assoc()){
            $rows[] = $row;
        }
        return $rows;
    }

    // thuc thi cau lenh truy van
    public function execute($query) {
        $result = $this->connection->query($query); 
        if($result == false){
            var_dump($result);
            die;
            return false;
        }
        return true;
    }

    // xoa du lieu
    public function delete($sql) {
        var_dump($sql);
        // $sql = "DELETE FROM $table WHERE id = $id";
        $result = $this->connection->query($sql); 
        if($result == false){
            return false;
        } 
        return true;     
    }
}
?>