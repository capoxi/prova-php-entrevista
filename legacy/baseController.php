<?php 
    
    require_once "connection.php";
    
    
    class baseController {


    public $connection;

    function __construct()
    {
        if (is_null($this->connection))
            $this->connection = new Connection();   
    }

    function checkExists($id) {
        if ($this->connection->query("SELECT * FROM posts WHERE id=".$id) !== false)
            return true;
        else return false;
    }
    }


?>