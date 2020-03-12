<?php

class Router {
    public function internal($data = object, $path = false) {
        global $response;

        $path = $path ? $path : Router::internalPath();

        if(file_exists($path)) {
            require_once($path);
            return true;
        } 

        return false;
    }

    public function internalPath() {
        $url = str_replace('/kubanabook/src/', '', $_SERVER["REDIRECT_URL"]);
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