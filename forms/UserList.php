<?php

include "header.php";
require "usersController.php";

$userController = new usersController();

$users = $userController->getUsers();

echo "<table border='1'>

    <tr>
        <th>ID</th>    
        <th>Nome</th>    
        <th>Email</th>
        <th style='text-align:right;padding-right: 0px; background-color: gray;'>Açõ</th>    
        <th style='padding-left: 0px; background-color: gray;'>es</th>
        <th>Active</th>
    </tr>
";

foreach($users as $user) {
    if ($user['active'] == 1)
    {
        echo sprintf(
                    "<tr>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td style='background-color: #f3eded;'>
                            <a href='editUser.php?id={$user['id']}'>Editar</a>
                        </td>
                        <td style=' background-color: #f3eded;'>
                            <span class='delete' data-id={$user['id']}>Excluir</span>
                        </td>
                        <td>%s</td>
                    </tr>",
                    $user['id'], $user['name'], $user['email'], $user['active']
        );
    }
}

echo "</table>";

echo "
<script>
        $(document).ready(function(){

            // Delete 
            $('.delete').click(function(){
            var el = this;
            
            // Delete id
            var deleteid = $(this).data('id');
            
            var confirmalert = confirm('Are you sure?');
            if (confirmalert == true) {
                // AJAX Request
                $.ajax({
                url: 'deleteUserAjax.php',
                type: 'GET',
                data: { id:deleteid },
                success: function(response){
        
                if(response == 1){
                // Remove row from HTML Table
                $(el).closest('tr').css('background','tomato');
                $(el).closest('tr').fadeOut(800,function(){
                    $(this).remove();
                });
                    }else{
                        alert(response);

                alert('Invalid ID.');
                    }
        
                }
                });
            }
        
            });
        
        });
   </script>
    ";