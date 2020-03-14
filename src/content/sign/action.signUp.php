<?php

if(isset($data->name) && (isset($data->email) || $data->phone) && isset($data->password) && isset($data->rePassword)) {
    $data->email = isset($data->email) ? $data->email : null;
    $data->phone = isset($data->phone) ? $data->phone : null;

    $sign = new Sign();

    $sign->signUp($data->name, $data->email, $data->phone, $data->password, $data->rePassword);
} else {
    $response->success = false;
    $response->content = ["message" => "Missing fields."];
}