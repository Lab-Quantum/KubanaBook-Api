<?php

$user = new User();
$user->verifyToken($data->token);

if($user->isValidUser()) {
    $response->success = true;
    $response->content = ["message" => "Is a valid user!"]; 
}