<?php

session_destroy();

$response->success = true;
$response->content = ["message" => "Sign Out!"];

session_start();