<?php

    global $serverRequest;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
        $serverRequest = $_POST;

    else if ($_SERVER['REQUEST_METHOD'] === 'GET') 
        $serverRequest = $_GET;

    function printTitleStep($title = "", $step = "")
    {
        return "
                <div id='titleContainer' style='text-align: center; padding-bottom: 2em;'>
                    <h1 id='Title'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='48' height='48' fill='currentColor' class='bi bi-apple' viewBox='0 0 16 16'>
                    <path d='M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43Zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282Z'></path>
                    <path d='M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43Zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282Z'></path>
                    </svg>   {$title}</h1>
                        
                    <h2 id='Step' style='color: black;background-color: #daffe2;'>&nbsp;{$step}</h2>
                </div>
        ";

    }

    function openElement($elementName, $elementClasses) { return "<{$elementName} class='{$elementClasses}'>"; }

    function closeElement($elementName) { return "</{$elementName}>"; }

    function printColorBox($colorName, $colorId = 0) {
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
                    font-size: x-large;
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