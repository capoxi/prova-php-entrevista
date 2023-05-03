<?php

    require_once "baseController.php";

    class colorsController extends baseController {

        function getColors() {

            return $this->connection->query("SELECT * FROM colors");
        }

        function getColor($id){
            return $this->connection->query("SELECT * FROM colors where id = ". $id, "user");//->fetch();
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
                SELECT DISTINCT users.name as userName, colors.name as colorName
                FROM user_colors 
                INNER JOIN colors ON (user_colors.color_id = colors.id)
                INNER JOIN users ON (user_colors.user_id = users.id)
                where users.id = {$userId}
        
        ";

            //print_r($sql);
            return $this->connection->query($sql);

        }

        function attachColor($userId, $colorId) {

            return $this->connection->query("
                INSERT into user_colors(user_id, color_id) values ('{$userId}','{$colorId}')
            ");

        }

    }