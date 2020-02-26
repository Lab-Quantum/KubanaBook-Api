<?php

class User {
    private $id = null;
    private $name = null;
    private $email = null;
    private $phone = null;
    private $active = null;

    public function setUser($idOrName) {
        global $pdo;

        $sql = "SELECT `id`, `name`, `email`, `phone`, `active` 
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
            $this->email = $userResult->email;
            $this->phone = $userResult->phone;
            $this->active = $userResult->active;

            return true;
        } else {
            return false;
        }
    }

    public function showInfos() {
        return [
            "id" => $this->id, 
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "active" => $this->active,
        ];
    }
}