<?php

if(isset($data->token)) {
    require_once("class.User.php");

    $user = new User();
    $user->verifyToken($data->token);

    if($user->isValidUser()) {
        $response->success = true;
        $response->content = ["message" => "Is a valid user!"]; 
    } else {
        $response->success = false;
        $response->content = ["message" => "Is not a valid user!"]; 
    }

    $response->sendResponse();
} else {
    $response->success = false;
    $response->content = ["message" => "Missing token."];
    $response->sendResponse();
}