<?php

    include __DIR__."/../includes/php/header.php";
    require __DIR__."/../controllers/usersController.php";
    require __DIR__."/../controllers/colorsController.php";


    echo printTitleStep("Colors Management","Remove Color from User");

    $userController = new usersController();

    $users = $userController->getUsers();

    $colorController = new colorsController();

    $colors = $colorController->getColors();

        echo "
        <script>
    
        $(document).ready(function(){
    
            // code to read selected table row cell data (values).
            $('#userTableGrid').on('click','.rowItem',function(){
                // get the current row
                var currentRow=$(this).closest('tr');
                
                $('#userTableGrid .selected').removeClass('selected');  
                currentRow.addClass('selected');
                
                var userId=currentRow.find('#userId').text(); // get current row 1st TD value
                var userName=currentRow.find('#userName').text(); // get current row 2nd TD
                var userEmail=currentRow.find('#userEmail').text(); // get current row 3rd TD
                var userColors=currentRow.find('#userColors').text();
    
                var data='Id: '+userId+' name: '+userName+' email: '+userEmail + 'colors:   ' + userColors;
    
                $('#selectedUserLabel').html('User: ' + data);
    
                $('#userMessages').css('visibility','visible')
    
                $('#_selectedUserId').val(userId);
                $('#_selectedUserName').val(userName);
                
            })

            $('.iColor').click(function(){
                var iColor = $(this);
                var selectedColorId = iColor.attr('colorId');
                var selectedUserId = iColor.attr('userId');
                alert('colorid: '+ selectedColorId + '  userid:  ' + selectedUserId);
                $('#_selectedColorId').val(selectedColorId);
                if(selectedColorId !== undefined) {
                    var confirmalert = confirm('Desanexar cor ' + iColor.attr('colorName') + ' do usuário ?'); 
                    if (confirmalert == true) {
                                // AJAX Request
                                $.ajax({
                                url: 'deleteColorFromUser.php',
                                type: 'GET',
                                data: { userId: selectedUserId, colorId: selectedColorId },
            
                                success: function(response) {
                                    if(response == 1){
                                        // Remove row from HTML Table
                                        /* 
                                        $(el).closest('tr').css('background','tomato');
                                        $(el).closest('tr').fadeOut(800,function(){
                                            $(this).remove();
                                        }); 
                                        */
                                        //alert(response);
                                        location.reload();
                                    } else {
                                            alert(response);
                                            alert('Invalid ID.');
                                    }
                                }
                        })
                    }
                }
            });
        });
        
        
    </script>
    ";

    // GRID / SELECT USUÁRIOS
    echo "<table id='userTableGrid' name='userTableGrid' class='container'>

        <tr>
            <th>#</th>
            <th>ID</th>    
            <th>Nome</th>    
            <th>Colors</th>
        </tr>
    ";


    foreach($users as $user) {
        if ($user['active'] == 1)
        {

            $userColors = $colorController->getColorsAttachedToUser($user['id']);
            echo "   
                            <tr class='rowItem' id='{$user['id']}'>
                            <td><input type='radio' id='selectedUserId' name='selectedUserId' value='%s'></input> </td>
                            <td><span id='userId'>{$user['id']}</span></td>
                            <td><span id='userName'>{$user['name']}</span></td>
                            <td><span id='userColors'>
                ";
            if (is_iterable($userColors)) {
                //var_dump($userColors);
                foreach ($userColors as $userColor) {
                    //var_dump($userColor);
                    echo printColorBoxUserIdColorId($userColor['colorName'], $userColor['colorId'], $userColor['userId']);
                    //echo " {$userColor['name']} ";
                }
            }
            
            //<span class='delete' data-id={$user['id']}>Excluir</span>

            echo 
                    "
                    </td>
                </tr>";
                
        }    
    }

    echo "</table>";


    // FIM DA GRID USUARIOS




    echo "
    <div id='userMessages' name='userMessages' class='btn btn-secondary' style='visibility: hidden;'>
        <input type='button' id='btnClearUserSelection' name='btnClearUserSelection' value='[ X ]'>
        <span id='selectedUserLabel'></span>
        <input type='hidden' id='_selectedUserId' value=0>
        <input type='hidden' id='_selectedColorId' value=0>
        <input type='hidden' id='_selectedUserName' value=0>
    </div>
        ";
