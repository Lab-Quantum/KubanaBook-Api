<?php

class Router {
    public function internal($path) {
        global $response;
        global $data;

        $path = Router::internalPath($path);

        if(file_exists($path)) {
            require_once($path);
            return true;
        }

        $response->success = false;
        $response->message = ["message" => "Invalid action!"];
        
        return false;
    }

    public function internalPath($path) {
        $url = str_replace('/kubanabook/src/', '', $path);
        $peaces = explode("/", $url);

        $path = SRC_PAGE."/content";
        $path .= "/".$peaces[0];
        if(count($peaces) > 2) {
            $path .= "/".$peaces[1];
            $path .= "/action.".$peaces[2].".php";
        } else {
            $path .= "/action.".$peaces[1].".php";
        }

        return $path;
    }
}