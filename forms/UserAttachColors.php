<?php

    include "header.php";
    require "usersController.php";
    require "colorsController.php";

    $userController = new usersController();

    $users = $userController->getUsers();

    $colorController = new colorsController();

    $colors = $colorController->getColors();

    // GRID / SELECT USUÁRIOS
    echo "<table border='1' id='userTableGrid' name='userTableGrid'>

        <tr>
            <th>#</th>
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
                        "<tr class='rowItem' id='{$user['id']}'>
                            <td><input type='radio' id='selectedUserId' name='selectedUserId' value='%s'></input> </td>
                            <td><span id='userId'>%s</span></td>
                            <td><span id='userName'>%s</span></td>
                            <td><span id='userEmail'>%s</td>
                            <td style='background-color: #f3eded;'>
                                <a href='editUser.php?id={$user['id']}'>Editar</a>
                            </td>
                            <td style=' background-color: #f3eded;'>
                                <span class='delete' data-id={$user['id']}>Excluir</span>
                            </td>
                            <td>%s</td>
                        </tr>",
                        $user['id'],
                        $user['id'], $user['name'], $user['email'], $user['active']
            );
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
                var col4=currentRow.find('#selectedUserId').val();
                var data='Id: '+col1+' name: '+col2+' email: '+col3 + 'radio:   ' + col4;

                $('#selectedUserLabel').text('User: ' + data);

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


    // GRID / SELECT COLORS
    echo "<table border='1' id='colorTableGrid' name='colorTableGrid'>

        <tr>
            <th>#</th>
            <th>ID</th>    
            <th>Nome</th>   
            <th>Escolher</th>
        </tr>
    ";

    foreach($colors as $color) {
        echo sprintf(
                    "<tr class='rowItem' id='{$color['id']}'>
                        <td><input type='radio' id='selectedColorId' name='selectedColorId' value='%s'></input> </td>
                        <td><span id='colorId'>%s</span></td>
                        <td><span id='colorName'>%s</span></td>
                        <td><input type='button' id='selectColor' value='Escolher'></td>
                    </tr>",
                    $color['id'],
                    $color['id'], $color['name']
        );
        }

    echo "</table>";

    echo "
    <div id='colorMessages' name='colorMessages' class='btn btn-secondary' style='visibility: hidden;'>
        <input type='button' id='btnClearColorSelection' name='btnColorUserSelection' value='[ X ]'>
        <span id='selectedColorLabel'></span>
        <input type='hidden' id='_selectedColorId' value=0>
    </div>
        ";

    echo "
    <script>
        $(document).ready(function(){

            // code to read selected table row cell data (values).
            $('#colorTableGrid').on('click','.rowItem',function(){
                // get the current row
                var currentRow=$(this).closest('tr');
                
                // TODO: remover classe 'selected'
                $('#colorTableGrid .selected').removeClass('selected');  
                currentRow.addClass('selected');
                
                var col1=currentRow.find('#colorId').text(); // get current row 1st TD value
                var col2=currentRow.find('#colorName').text(); // get current row 2nd TD
                var col3=currentRow.find('#selectedColorId').val();
                var data='Id: '+col1+' name: '+col2+' radio: '+col3;

                $('#selectedColorLabel').text('Color: ' + data);

                $('#colorMessages').css('visibility','visible')

                $('#_selectedColorId').val(col1);
                
                //alert(data);
            });
        });
    </script>
    ";


    // SCRIPT PARA CADASTRAR A CONEXAO ENTRE COR E USUARIO NO BD VIA AJAX
    echo "<input type='button' id='btnAttach' name='btnAttach' value='Anexar'>";
    echo "
    <script>
                $('#btnAttach').click(function(){
                var el = this;
                
                // Delete id
                var userId = $('#_selectedUserId').val();
                var colorId = $('#_selectedColorId').val();
                
                var confirmalert = confirm('Are you sure?');
                if (confirmalert == true) {
                    // AJAX Request
                    $.ajax({
                    url: 'attachColorAjax.php',
                    type: 'GET',
                    data: { userId:userId, colorId: colorId },
                    success: function(response){
            
                        if(response == 1)
                            alert('Response: 1');
                        else
                            alert('Response: ' + response);
                    }})};
                });
    </script>
        ";
?>
