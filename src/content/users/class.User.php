<?php

class User {
    private $id = null;
    private $name = null;
    private $role = null;
    private $email = null;
    private $phone = null;
    private $active = null;
    private $banned = null;

    public function setUser($idOrName) {
        global $pdo;

        $sql = "SELECT `id`, `name`, `role`, `email`, `phone`, `active`, `banned`
            FROM `users` 
            WHERE `id` = ? or `name` = ?";
        
        $select = $pdo->prepare($sql);
        $select->bindParam(1, $idOrName);
        $select->bindParam(2, $idOrName);
        $select->execute();

        $userResult = $select->fetch();

        if(isset($userResult->id)) {
            $this->id = $userResult->id;
            $this->name = $userResult->name;
            $this->role = $userResult->role;
            $this->email = $userResult->email;
            $this->phone = $userResult->phone;
            $this->active = $userResult->active;
            $this->banned = $userResult->banned;

            return true;
        } else {
            return false;
        }
    }

    public function showInfos() {
        return [
            "id" => $this->id, 
            "name" => $this->name,
            "role" => $this->role,
            "email" => $this->email,
            "phone" => $this->phone,
            "active" => $this->active,
            "banned" => $this->banned,
        ];
    }

    public function isValidUser() {
        if(isset($this->id) && $this->active == 1 && $this->banned == 0) {
            return true;
        } 

        return false;
    }

    public function isAdmin() {
        if($this->role == 1 && $this->isValidUser()) {
            return true;
        } 

        return false;
    }

    protected function generateHashToken($id) {
        $hash = password_hash($id.KEY_JWT, PASSWORD_DEFAULT);
        
        $body   = json_encode(["id" => $id]);
        $auth   = json_encode(["secret" => $hash]);

        $body   = base64_encode($body);
        $auth   = base64_encode($auth);

        $token = $body.'.'.$auth;

        return $token;
    }

    public function verifyToken($token = null) {
        global $response;

        $token = $token ? $token : $_SESSION['token'];

        $token = explode(".", $token);

        if(count($token) != 2) {
            $response->success = false;
            $response->content = ["message" => "Invalid Token!"]; 
            return false;
        }

        $body = json_decode(base64_decode($token[0]));
        $auth = json_decode(base64_decode($token[1]));

        if(password_verify($body->id.KEY_JWT, $auth->secret)) {
            $this->setUser($body->id);
            $user = $this->showInfos();

            $response->success = true;
            $response->content = ["message" => "Valid Token!", "user" => $user]; 
            return $user;
        } else {
            $response->success = false;
            $response->content = ["message" => "Invalid Token!"]; 
            return false;
        }
    }
}