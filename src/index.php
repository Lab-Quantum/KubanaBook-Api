<?php 

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST, GET");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

define('SRC_PAGE', $_SERVER['DOCUMENT_ROOT']."/kubanabook/src");
define('IMG_PAGE', $_SERVER['DOCUMENT_ROOT']."/kubanabook/images");

$data = isset($_POST) ? (object) $_POST : json_decode(file_get_contents("php://input"));

require_once(SRC_PAGE.'/requires.php');

Router::internal($data);

$response->sendResponse();