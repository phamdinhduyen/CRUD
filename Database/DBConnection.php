<?php 
class DBConnection {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "phone";

    protected $connection;
    

    public function connect(){
        if(!isset($this -> connection)){
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            if(!isset($this -> connection)) {
                exit;
            }
        }
        return $this->connection;
    }
}
 ?>