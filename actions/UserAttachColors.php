<?php

    include __DIR__."/../includes/php/header.php";
    require __DIR__."/../controllers/usersController.php";
    require __DIR__."/../controllers/colorsController.php";
    

    echo printTitleStep("Attach Color to User","Select User");


    $userController = new usersController();

    $users = $userController->getUsers();

    $colorController = new colorsController();

    $colors = $colorController->getColors();

    echo "
    <div id='userMessages' name='userMessages' class='btn btn-warning'>
        <input type='button' id='btnClearUserSelection' name='btnClearUserSelection' value='[ X ]'>
        <span id='selectedUserLabel'></span>
        <input type='hidden' id='_selectedUserId' value=0>
    </div>
   
    <script>
        function editStep(step) { $('#Step').text(step); }

        $('#btnClearUserSelection').click(function() {
            $('#userMessages').hide();
            $('#userTableGrid').show();
            $('#_selectedUserId').val(0);
            $('#colorTableGrid').hide();
            $('#btnAttach').hide();
            alert('Please, choose the user again.');
            editStep('Select User');
        });
    </script>

    ";

    
    echo "
    <div id='colorMessages' name='colorMessages' class='btn btn-warning'>
        <input type='button' id='btnClearColorSelection' name='btnColorUserSelection' value='[ X ]'>
        <span id='selectedColorLabel'></span>
        <input type='hidden' id='_selectedColorId' value=0>
    </div>

    <script>
    $('#btnClearColorSelection').click(function() {
        $('#colorMessages').hide();
        if ($('#_selectedUserId').val() !== '0')
        { 
            $('#colorTableGrid').show(); 
        }
        $('#_selectedColorId').val(0);
        $('#btnAttach').hide();
        alert('Please, select the color again.');
        editStep('Select User');

    });
    </script>



    ";


    echo "<input type='button' class='btn btn-primary' id='btnAttach' name='btnAttach' value='Attach Color'>";

    // GRID / SELECT USUÁRIOS
    echo "
                <table border='1' id='userTableGrid' name='userTableGrid' class='container'>

                    <tr>
                        <th>ID</th>    
                        <th>Nome</th>    
                        <th>Email</th>
                    </tr>
    ";

    foreach($users as $user) {
        if ($user['active'] == 1)
        {
            echo sprintf(
                        "<tr class='rowItem' id='{$user['id']}'>
                            <td><span id='userId'>%s</span></td>
                            <td><span id='userName'>%s</span></td>
                            <td><span id='userEmail'>%s</td>
                        </tr>",
                        $user['id'], $user['name'], $user['email']
            );
        }
    }

    echo "</table>";

    echo "
    <script>
        $(document).ready(function(){

            $('#userMessages').hide();
            $('#colorMessages').hide();
            $('#colorTableGrid').hide();
            $('#btnAttach').hide();

            $('#userTableGrid').on('click','.rowItem',function(){

                var currentRow=$(this).closest('tr');
            
                $('#userTableGrid .selected').removeClass('selected');  
                currentRow.addClass('selected');
                
                var col1=currentRow.find('#userId').text(); 
                var col2=currentRow.find('#userName').text(); 
                var col3=currentRow.find('#userEmail').text(); 
                var data='Id: '+col1+' name: '+col2+' email: '+col3;

                $('#selectedUserLabel').text('User: ' + data);

                $('#userMessages').show();
                
                $('#userTableGrid').hide();

                $('#_selectedUserId').val(col1);
                
                if ( $('#_selectedColorId').val() == 0 ) { 
                    $('#colorTableGrid').show();
                    $('#Step').text('Select Color');
                } else {

                    $('#Step').text('Verify and Attach the Color');
        
                    $('#btnAttach').show();
                }
                
            });
        });
    </script>
    ";

    // FIM DA GRID USUARIOS



    // GRID / SELECT COLORS
    echo "
        <table id='colorTableGrid' name='colorTableGrid' class='container'>
            <tr>
                <th width='5%'>ID</th>    
                <th>Nome</th>   
            </tr>
        ";

    foreach($colors as $color) {
        $colorBox = printColorBox($color['name'],$color['id']);
        echo sprintf(
                    "<tr class='rowItem' id='{$color['id']}'>
                        <td><span id='colorId'>%s</span></td>
                        <td>{$colorBox}</td>
                    </tr>",
                    $color['id']
        );
        }

    echo "</table>";

    /*
    echo "
        <div class='row'><div class='col'></div>
    ";*/

    echo "
        <script>
        $('.iColor').click(function(){
            var iColor = $(this);
            var selectedColorId = iColor.attr('colorId');
            var selectedColorName = iColor.attr('colorName');


            $('#_selectedColorId').val(selectedColorId);

            $('#selectedColorLabel').text('Color=> id: ' + selectedColorId + ' name: ' + selectedColorName);

            $('#colorMessages').show();

            $('#colorTableGrid').hide();

            if ( $('#_selectedUserId').val() == '0' ) { 
                
                $('#userTableGrid').show();
                $('#Step').text('Select User');

            } else {

                $('#Step').text('Verify and Attach the Color');
    
                $('#btnAttach').show();
            }

        });
        </script>
    
    ";


    // SCRIPT PARA CADASTRAR A CONEXAO ENTRE COR E USUARIO NO BD VIA AJAX
    echo "
    <script>
                $('#btnAttach').click(function(){
                var el = this;
                
                var userId = $('#_selectedUserId').val();
                var colorId = $('#_selectedColorId').val();
                
                var confirmalert = confirm('Are you sure?');
                if (confirmalert == true) {
                    $.ajax({
                    url: 'attachColorAjax.php',
                    type: 'GET',
                    data: { userId:userId, colorId: colorId },
                    success: function(response){
                        if(response == 1)
                            alert('Success!');
                        else
                            alert('Response: ' + response);
                    }})};
                });
    </script>
        ";
?>
