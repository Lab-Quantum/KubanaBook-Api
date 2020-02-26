<?php

if(isset($data->user)) {
    require_once("class.User.php");

    $user = new User();

    if($user->setUser($data->user)) {
        $response->success = true;
        $response->content = ["user" => $user->showInfos()];
        $response->sendResponse();
    } else {
        $response->success = false;
        $response->content = ["message" => "Invalid user data."];
        $response->sendResponse();
    }
} else {
    $response->success = false;
    $response->content = ["message" => "No user data send."];
    $response->sendResponse();
}
