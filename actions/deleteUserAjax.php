<?php 

    require __DIR__.'/../includes/php/globals.php';
    require __DIR__.'/../controllers/usersController.php';

    //echo var_dump($serverRequest);

    $id = 0;

    if(isset($serverRequest['id'])){

    $id = $serverRequest['id'];

    }

    if($id > 0){
        
        $userController = new usersController();
        
        $totalrows = $userController->deleteUser($id);
        
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