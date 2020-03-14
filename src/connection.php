<?php

define('DB_SERVER',   '192.168.1.8');
define('DB_USER',     'root');
define('DB_PASSWORD', 'root');
define('DB_NAME',     'kubanabook');

try {
    $pdo = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_LAZY);
    $pdo->exec("set names utf8");
} catch (PDOException $error) {
    $response->success = false;
    $response->content = ["message" => "Fail to connect to database", "error" => $error];
    $response->sendResponse();
}