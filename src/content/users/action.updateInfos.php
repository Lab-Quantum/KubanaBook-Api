<?php

if(isset($data->token)) {
    $user = new User();

    $user->verifyToken($data->token);
    
    if($user->isValidUser()) {
        $user->updateInfos($data);
    }
} else {
    $response->success = false;
    $response->content = ["message" => "Missing fields."];
}