<?
    include __DIR__."/../includes/php/header.php";
    require __DIR__."/../controllers/colorsController.php";

    $colorController = new colorsController();

    $colors = $colorController->getColors();


    // GRID / SELECT COLORS
        echo "<table id='colorTableGrid' name='colorTableGrid'>

            <tr>
                <th>#</th>
                <th>ID</th>    
                <th>Name</th>   
            </tr>
        ";

        foreach($colors as $color) {
            $colorBox = printColorBox($color['name']);
            echo sprintf(
                        "<tr class='rowItem' id='{$color['id']}'>
                            <td><input type='radio' id='selectedColorId' name='selectedColorId' value='%s'></input> </td>
                            <td><span id='colorId'>%s</span></td>
                            <td>{$colorBox}</td>
                        </tr>",
                        $color['id'],
                        $color['id']
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