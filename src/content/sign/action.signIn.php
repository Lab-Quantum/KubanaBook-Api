<?php

if(isset($data->user) && isset($data->password)) {
    $sign = new Sign();
    $sign->signIn($data->user, $data->password);
} else {
    $response->success = false;
    $response->content = ["message" => "Missing fields."];
}