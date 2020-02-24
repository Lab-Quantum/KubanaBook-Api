<?php

class Response {
    public $success = false;
    public $content = [];

    public function sendResponse($success = null, $content = null) {
        $success = $success ? $success : $this->success;
        $content = $content ? $content : $this->content;

        echo json_encode([
            "success" => $success,
            "content" => $content
        ], JSON_NUMERIC_CHECK);
    }
}