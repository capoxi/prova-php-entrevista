<?php

/*
class user {
    public static $id;
    public static $name;
}

class color { 
    public static $id;
    public static $name;
} */

class Connection {

    private $databaseFile;
    private $connection;

    public function __construct()
    {
        $path = __DIR__ . "/../../database/db.sqlite";

        /* DEBUG INFO
        echo "DBPATH: ";
        print_r($path); */
        
        $this->databaseFile = $path;
        $this->connect();
    }

    private function connect()
    {
        return $this->connection = new PDO("sqlite:{$this->databaseFile}");
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }

    public function query($query)
    {
        return $this->getConnection()->query($query);
    }

    public function exec($query)
    {
        return $this->getConnection()->exec($query);
    }
}