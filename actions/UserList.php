<?php

    include __DIR__."/../includes/php/header.php";
    require __DIR__."/../controllers/usersController.php";

    echo printTitleStep("User Management","Users List");

    echo openElement("div","container");

    $userController = new usersController();

    $users = $userController->getUsers();

    echo "<table class='container'>

        <tr>
            <th>ID</th>    
            <th>Nome</th>    
            <th>Email</th>
            <th style='text-align:right;padding-right: 0px;'>Act</th>    
            <th style='padding-left: 0px;'>ions</th>
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
                            <td style='text-align:right;padding-right: 0px; '>
                                <a href='UserForm.php?id={$user['id']}'><b>Edit</b></a>
                            </td>
                            <td>
                                <a class='delete' data-id={$user['id']}>Remove</a>
                            </td>
                        </tr>",
                        $user['id'], $user['name'], $user['email']
            );
        }
    }

    echo closeElement("table");

    echo "
        <script>
                $(document).ready(function(){

                    $('.delete').click(function(){

                        var el = this;
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
                                $(el).closest('tr').css('background','tomato');
                                $(el).closest('tr').fadeOut(800,function(){
                                    $(this).remove();
                                });
                            } else {
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

    echo closeElement("div");

?>