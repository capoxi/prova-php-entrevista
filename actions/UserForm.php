<?php
    include __DIR__."/../includes/php/header.php";
    require __DIR__.'/../controllers/usersController.php';

    (
        isset
        (
            $serverRequest['id']
        )?
        $id = $serverRequest['id']:
        $id = 0
    );

    $userController = new usersController();

    if (
        !(isset($serverRequest['id'])) &&
        isset($serverRequest['name']) && 
        isset($serverRequest['email'] )
        )
    {
        if ($userController->createUser($serverRequest['name'], $serverRequest['email']))
            echo printMessages("The user has benn created successfully.", "success");
        else echo printMessages("Error creating user. Please try again.", "danger");
        /*
        if ($userController->editUser($id, $serverRequest['name'], $serverRequest['email']))
            echo "Usuario Editado com Sucesso";
        else
            echo "Erro ao Editar Usuario";*/
    } else if (
        isset($serverRequest['id']) && 
        isset($serverRequest['name']) && 
        isset($serverRequest['email'])
        )
    {
        $userController->editUser($id, $serverRequest['name'], $serverRequest['email']);
        echo "
            <script>
                window.location.replace('UserList.php');
            </script>
        ";


        /*
        if ($userController->editUser($id, $serverRequest['name'], $serverRequest['email']))
            echo "Usuario Editado com Sucesso";
        else
            echo "Erro ao Editar Usuario";*/
    }

    if ($id !== 0){
        $user = $userController->getUser($id)->fetch();
        echo "
                <h1>Changing data for User <b>{$user['id']}</b></h1>
                <form action='UserForm.php' method='get'>
                    <input type='hidden' id='id' name='id' value='{$user['id']}'>
                    <label for='name'>Name: </label>
                    <input type='text' id='name' name='name' value='{$user['name']}'>
                    <label for='email'>Email: </label>
                    <input type='text' id='email' name='email' value='{$user['email']}'>
                    <input type='submit' value='Save Changes'>
                </form>
                ";
    } else
        echo "
                <h1>Create a new user</h1>
                <form action='UserForm.php' method='get'>
                    <label for='name'>Name: </label>
                    <input type='text' id='name' name='name' value=''>
                    <label for='email'>Email: </label>
                    <input type='text' id='email' name='email' value=''>
                    <input type='submit' value='Save'>
                </form>
                ";



?>