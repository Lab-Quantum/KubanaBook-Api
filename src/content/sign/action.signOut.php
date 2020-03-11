<?php

session_destroy();

$response->success = true;
$response->content = ["message" => "Sign Out!"];
$response->sendResponse(); 

session_start();