<?php

if(isset($data->user)) {
    $user = new User();

    if($user->setUser($data->user)) {
        $response->success = true;
        $response->content = ["user" => $user->showInfos()];
    } else {
        $response->success = false;
        $response->content = ["message" => "Invalid user data."];
    }
} else {
    $response->success = false;
    $response->content = ["message" => "No user data send."];
}
