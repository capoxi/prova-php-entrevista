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
    
            $('#userTableGrid').on('click','.rowItem',function(){

                var currentRow=$(this).closest('tr');
                
                $('#userTableGrid .selected').removeClass('selected');  

                currentRow.addClass('selected');
                
                var userId=currentRow.find('#userId').text(); 
                var userName=currentRow.find('#userName').text(); 
                var userEmail=currentRow.find('#userEmail').text();
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
                var selectedUserId = iColor.attr('userId');$('#_selectedColorId').val(selectedColorId);
                if(selectedColorId !== undefined) {
                    var confirmalert = confirm('Detach color ' + iColor.attr('colorName') + ' from the selected user?'); 
                    if (confirmalert == true) {
                                $.ajax({
                                url: 'deleteColorFromUser.php',
                                type: 'GET',
                                data: { userId: selectedUserId, colorId: selectedColorId },
            
                                success: function(response) {
                                    if(response == 1){
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
                foreach ($userColors as $userColor) {
                    echo printColorBoxUserIdColorId($userColor['colorName'], $userColor['colorId'], $userColor['userId']);
                }
            }
            echo "
                    </td>
                </tr>

                ";
                
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
