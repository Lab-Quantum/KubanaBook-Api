<?php

$user = new User();
$user->verifyToken($data->token);

if($user->isAdmin()) {
    $response->success = true;
    $response->content = ["message" => "Is admin!"]; 
} else {
    $response->success = false;
    $response->content = ["message" => "Is not admin!"]; 
}