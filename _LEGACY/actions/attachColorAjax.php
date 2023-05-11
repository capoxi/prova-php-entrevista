<?php 

    require __DIR__.'/../includes/php/globals.php';
    require __DIR__.'/../controllers/colorsController.php';

    //echo var_dump($serverRequest);

    $userId = 0;
    $colorId = 0;

    if(isset($serverRequest['userId']) && isset($serverRequest['colorId']) ){

        $userId = $serverRequest['userId'];
        $colorId = $serverRequest['colorId'];

    }

    if( ($colorId > 0) && ($colorId > 0) ){
        
        $colorController = new colorsController();
        
        $result = $colorController->attachColor($userId,$colorId);
            echo $result;
            exit;
        
        if($result == false){
            echo "An error occured, please contact the system admin.";
            exit;
        }else {
            echo $result;
            exit;
        }
    }

    echo 0;
    exit;



?>