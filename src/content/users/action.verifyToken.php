<?php

if(isset($data->token)) {
    require_once("class.User.php");

    $user = new User();
    $user->verifyToken($data->token);

    $response->sendResponse();
} else {
    $response->success = false;
    $response->content = ["message" => "Missing token."];
    $response->sendResponse();
}