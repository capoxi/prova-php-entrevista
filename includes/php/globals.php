<?php

    global $serverRequest;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        $serverRequest = $_POST;

    else if ($_SERVER['REQUEST_METHOD'] === 'GET') 
        $serverRequest = $_GET;

    

    function printColorBox($colorName, $colorId) {
        $colorHTML = "#000000";
        switch ($colorName) {
            case "Red":
                $colorHTML = "orangered";
                break;
            case "Blue":
                $colorHTML = "aqua";
                break;
            case "Green":
                $colorHTML = "#00FF00";
                break;
            default:
                $colorHTML = $colorName;
                break;
        }
        return "
            <i class='iColor' style='
                    background-color: {$colorHTML};
            ' colorId={$colorId} colorName='{$colorName}'>
                &nbsp;&nbsp;{$colorName}&nbsp;&nbsp;
            </i>&nbsp;
        ";
    }

    function printColorBoxUserIdColorId($colorName, $colorId, $userId) {
        $colorHTML = "#000000";
        switch ($colorName) {
            case "Red":
                $colorHTML = "orangered";
                break;
            case "Blue":
                $colorHTML = "aqua";
                break;
            case "Green":
                $colorHTML = "#00FF00";
                break;
            default:
                $colorHTML = $colorName;
                break;
        }
        return "
            <i class='iColor' style='
                    background-color: {$colorHTML};
            ' userId={$userId} colorId={$colorId} colorName='{$colorName}'>
                &nbsp;&nbsp;{$colorName}&nbsp;&nbsp;
            </i>&nbsp;
        ";
    }

    /*
    enum MessageType {
        case primary;
        case secundary;
        case success;
        case danger;
        case info;
        case warning;
        case light;
        case dark;

    }*/

    function printMessages(
                            $message,
                            //MessageType $type
                            $type =  "primary"| "secondary" | "success" | "danger" | "info" |  "warning" | "light" | "dark"
    ){
        return "
            <div class='alert alert-{$type} alert-dismissible' role='alert'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                {$message}
            </div>";
    }

?>