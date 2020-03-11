<?php

if(isset($data->token)) {
    require_once("class.User.php");

    $user = new User();
    $user->verifyToken($data->token);

    if($user->isAdmin()) {
        $response->success = true;
        $response->content = ["message" => "Is admin!"]; 
    } else {
        $response->success = false;
        $response->content = ["message" => "Is not admin!"]; 
    }

    $response->sendResponse();
} else {
    $response->success = false;
    $response->content = ["message" => "Missing token."];
    $response->sendResponse();
}