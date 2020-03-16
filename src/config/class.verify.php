<?php

class verify {
    public function email($email) {
        global $response;
        
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $response->content = ["message" => "Email is not valid"];
            return false;  
        }
    }

    public function phone($phone) {
        global $response;

        $phone = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $phone))))));

        if(preg_match('/^[0-9]{11}+$/', $phone)) {
            return true;
        } else {
            $response->success = false;
            $response->content = ["message" => "Phone number is not valid"];
            return false;
        }
    }

    public function int($int) {
        global $response;

        if(is_int($int)) {
            return true;
        } else {
            $response->success = false;
            $response->content = ["message" => "The value isn't a integer type"];
            return false;
        }
    }

    public function string($string) {
        global $response;

        if(!empty($string)) {
            return true;
        } else {
            $response->success = false;
            $response->content = ["message" => "The value isn't a string type"];
            return false;
        }
    }
}