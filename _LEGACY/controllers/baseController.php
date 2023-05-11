<?php 
    
    require_once __DIR__ . "/../includes/php/connection.php";
    include_once __DIR__."/../includes/php/globals.php";
    
    
    class baseController {


    public $connection;

    function __construct()
    {
        if (is_null($this->connection))
            $this->connection = new Connection();  
    }
    
    function countItems($tableName) {
        return ($this->connection->query("SELECT COUNT(*) FROM {$tableName}"));
    }

    function checkExists($id) {
        if ($this->connection->query("SELECT * FROM posts WHERE id=".$id) !== false)
            return true;
        else return false;
    }
    }


?>