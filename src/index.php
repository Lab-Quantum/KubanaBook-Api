<?php 

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define('SRC_PAGE', $_SERVER['DOCUMENT_ROOT']."/kubanabook/src");
define('IMG_PAGE', $_SERVER['DOCUMENT_ROOT']."/kubanabook/images");

require_once(SRC_PAGE.'/requires.php');

$data = isset($_POST) ? (object) $_POST : json_decode(file_get_contents("php://input"));

if(isset($data) && isset($data->section) && isset($data->action)) {
    $actionFile = SRC_PAGE.'/content';
    $actionFile .= '/'.$data->section;
    $actionFile .= isset($data->subSection) ? '/'.$data->section : '';
    $actionFile .= '/action.'.$data->action.'.php';

    if(file_exists($actionFile)) {
        require_once($actionFile);
    } else {
        $response->success = false;
        $response->content = ["message" => "Invalid action"];
        $response->sendResponse();
    }
} else {
    $response->success = false;
    $response->content = ["message" => "Found no data, must post something"];
    $response->sendResponse();
}