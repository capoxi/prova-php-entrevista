<?php

    include __DIR__."/../includes/php/header.php";
    require __DIR__."/../controllers/usersController.php";
    require __DIR__."/../controllers/colorsController.php";

    $userController = new usersController();

    $users = $userController->getUsers();

    $colorController = new colorsController();

    $colors = $colorController->getColors();

    // GRID / SELECT USUÁRIOS
    echo "<table id='userTableGrid' name='userTableGrid'>

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
                    //print_r($userColor);
                    echo printColorBoxUserIdColorId($userColor['colorName'],$userColor['userId'],$userColor['colorId']);
                    //echo " {$userColor['name']} ";
                }
            }
            echo 
                    "
                    </td>
                </tr>";
                
        }    
    }

    echo "</table>";

    echo "
    <script>
        $(document).ready(function(){

            // code to read selected table row cell data (values).
            $('#userTableGrid').on('click','.rowItem',function(){
                // get the current row
                var currentRow=$(this).closest('tr');
                
                // TODO: remover classe 'selected'
                $('#userTableGrid .selected').removeClass('selected');  
                currentRow.addClass('selected');
                
                var col1=currentRow.find('#userId').text(); // get current row 1st TD value
                var col2=currentRow.find('#userName').text(); // get current row 2nd TD
                var col3=currentRow.find('#userEmail').text(); // get current row 3rd TD
                var col4=currentRow.find('#userColors').text();
                var data='Id: '+col1+' name: '+col2+' email: '+col3 + 'colors:   ' + col4;

                $('#selectedUserLabel').html('User: ' + data);

                $('#userMessages').css('visibility','visible')

                $('#_selectedUserId').val(col1);
                
                //alert(data);
            });
        });
    </script>
    ";

    // FIM DA GRID USUARIOS




    echo "
    <div id='userMessages' name='userMessages' class='btn btn-secondary' style='visibility: hidden;'>
        <input type='button' id='btnClearUserSelection' name='btnClearUserSelection' value='[ X ]'>
        <span id='selectedUserLabel'></span>
        <input type='hidden' id='_selectedUserId' value=0>
    </div>
        ";
?>
