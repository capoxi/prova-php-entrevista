<?php

    require_once "baseController.php";

    class colorsController extends baseController {

        function getColors() {

            return $this->connection->query("SELECT * FROM colors");
        }

        function getColor($id){
            return $this->connection->query("SELECT * FROM colors where id = ". $id, "user");//->fetch();
        }

        function countColors() {
            return $this->countItems("colors");
        }


        /* 
            select distinct users.name, colors.name
            from user_colors
            inner join users on (user_colors.user_id = users.id)
            inner join colors on (user_colors.color_id = color_id )
            where user_colors.user_id = x 
        */

        function getColorsAttachedToUser($userId) {

        $sql = "
                SELECT DISTINCT  users.id as userId, users.name as userName, colors.id as colorId, colors.name as colorName
                FROM user_colors 
                INNER JOIN colors ON (user_colors.color_id = colors.id)
                INNER JOIN users ON (user_colors.user_id = users.id)
                WHERE users.id = {$userId}
        ";

            //print_r($sql);
            return $this->connection->query($sql);

        }

        function userHasColor($userId, $colorId) {
            $hasColor = $this->connection->query("
                SELECT * FROM user_colors where user_id = {$userId} and color_id = {$colorId}
            ")->fetchObject();

            //print_r($hasColor);
            if ($hasColor == false) { return false; } else { return true;}


        }

        function attachColor($userId, $colorId) {
            if ($this->userHasColor($userId, $colorId) == false) {  
                $result = $this->connection->query("
                    INSERT into user_colors(user_id, color_id) values ('{$userId}','{$colorId}')
                "); 
                //print_r($result);
                //exit;
                if (($result !== false)) { return "Sucess!"; }
            }
            else return "The user already has this color attached.";

        }

        function removeColorFromUser($userId, $colorId) {
            $sql = "
                        DELETE FROM user_colors WHERE user_id = {$userId} and color_id={$colorId}
                    ";
            //print_r($sql);
            //return 
            $result = $this->connection->query($sql);

            if (($result !== false)) { return "Sucess!"; }
            else return "Error removing color, contact the system admin.";
        }
    }

    ?>