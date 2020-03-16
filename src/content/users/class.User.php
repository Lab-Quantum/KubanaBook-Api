<?php

class User {
    private $id = null;
    private $name = null;
    private $role = null;
    private $email = null;
    private $phone = null;
    private $active = null;
    private $banned = null;

    protected $fields = array();

    public function __construct($idOrName = null) {
        if(isset($id)) {
            $this->setUser($idOrName);
        }

        $this->fields = [
            "id" => [
                "required"  => 0,
                "editable"  => 0,
                "type"      => "int"
            ],
            "name" => [
                "required"  => 1,
                "editable"  => 1,
                "type"      => "string"
            ],
            "role" => [
                "required"  => 0,
                "editable"  => 0,
                "type"      => "int"
            ],
            "email" => [
                "required"  => 0,
                "editable"  => 1,
                "type"      => "email"
            ],
            "phone" => [
                "required"  => 0,
                "editable"  => 1,
                "type"      => "phone"
            ],
            "active" => [
                "required"  => 0,
                "editable"  => 0,
                "type"      => "int"
            ],
            "banned" => [
                "required"  => 0,
                "editable"  => 0,
                "type"      => "int"
            ],
        ];
    }

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
        global $response;

        if(isset($this->id) && $this->active == 1 && $this->banned == 0) {
            return true;
        } 
        
        $response->success = false;
        $response->content = ["message" => "Is not a valid user!"]; 
        
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

    public function updateInfos($userInfos) {
        global $pdo;
        global $response;
        unset($userInfos->token);

        $set = "";

        foreach($userInfos as $field => $value) {
            if($this->fields[$field]["editable"] == 1) {
                $type = $this->fields[$field]["type"];
                
                if(!verify::$type($value)) {
                    return false;
                }

                $set .= " ".$field." = '".$value."' ";
            }
        }

        $sql = "UPDATE `users` SET ".$set." WHERE `id` = ?";

        try {
            $update = $pdo->prepare($sql);
            $update->bindParam(1, $this->id);
            $update->execute();

            $response->success = true;
            $response->content = ["message" => "Updated Informations"];

            return true;
        } catch(PDOException $e) {
            $error = $e->getMessage();

            $response->success = false;
            $response->content = ["message" => "Error when trying to update user", "error" => $error];

            return false;
        }
    }
}