<?php 

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define('SRC_PAGE', $_SERVER['DOCUMENT_ROOT']."/KubanaBook-Api/src");
define('IMG_PAGE', $_SERVER['DOCUMENT_ROOT']."/KubanaBook-Api/images");

require_once(SRC_PAGE.'/requires.php');

$data = json_decode(file_get_contents("php://input"));

if(!empty($data)) {
    $actionFile = SRC_PAGE.'/content';
    $actionFile .= '/'.$data->section;
    $actionFile .= $data->subSection ? '/'.$data->section : '';
    $actionFile .= '/'.$data->action;

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