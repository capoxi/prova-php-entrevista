<?php 

    require 'globals.php';
    require 'colorsController.php';

    //echo var_dump($serverRequest);

    $userId = 0;
    $colorId = 0;

    if(isset($serverRequest['userId']) && isset($serverRequest['colorId']) ){

        $userId = $serverRequest['userId'];
        $colorId = $serverRequest['colorId'];

    }

    if( ($colorId > 0) && ($colorId > 0) ){
        
        $colorController = new colorsController();
        
        $totalrows = $colorController->attachColor($userId,$colorId);
        
        if($totalrows > 0){
            echo 1;
            exit;
        }else{
            echo 0;
            exit;
        }
    }

    echo 0;
    exit;



?>