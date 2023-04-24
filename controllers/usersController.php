<?php

    require_once "baseController.php";

    class usersController extends baseController {

        function getUsers() {
            return $this->connection->query("SELECT * FROM users");
        }

        function getUser($id){
            return $this->connection->query("SELECT * FROM users where id = ". $id, "user");//->fetch();
        }

        function createUser($name, $email){
            print_r($this->connection->query("INSERT into users(name, email) values ('{$name}','{$email}')"));
        }

        function editUser($id, $newName, $newEmail){
            $sql = "UPDATE users SET name = '{$newName}', email = '{$newEmail}' where id = {$id}";
            return $this->connection->exec($sql);
        }

        function deleteUser($id) {
            //if ( $this->checkExists($id) ) {
                $sql = "UPDATE users SET active = 0 where id = {$id}";
                return $this->connection->exec($sql);
            //} else return false;
        }
    }

?>
