<?php

if(isset($data->user) && isset($data->password)) {
    require_once("class.Sign.php");

    $sign = new Sign();
    $sign->signIn($data->user, $data->password);

    $response->sendResponse();
} else {
    $response->success = false;
    $response->content = ["message" => "Missing fields."];
    $response->sendResponse();
}