<?php

    require_once "../includes/php/globals.php";

    require_once "baseController.php";

    class usersController extends baseController {

        function getUsers() {
            return $this->connection->query("SELECT * FROM users");
        }

        function getUser($id){
            return $this->connection->query("SELECT * FROM users where id = ". $id, "user");//->fetch();
        }


        function countUsers() {
            return $this->countItems("users");
        }

        function createUser($name, $email){
            if (validateEmail($email)){
                if (
                    $this->connection->query("INSERT into users(name, email) values ('{$name}','{$email}')") !== false
                    ) { 
                    return true;
                }
            }
            else { return false; }
        }

        function editUser($id, $newName, $newEmail){
            if (validateEmail($newEmail)) {
                $sql = "UPDATE users SET name = '{$newName}', email = '{$newEmail}' where id = {$id}";
                return $this->connection->exec($sql);
            }
            else { return false; }
        }

        function deleteUser($id) {
                $sql = "UPDATE users SET active = 0 where id = {$id}";
                return $this->connection->exec($sql);
        }
    }

?>
