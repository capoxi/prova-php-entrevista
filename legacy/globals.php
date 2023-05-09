<?php

    global $serverRequest;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        $serverRequest = $_POST;

    else if ($_SERVER['REQUEST_METHOD'] === 'GET') 
        $serverRequest = $_GET;

    ?>