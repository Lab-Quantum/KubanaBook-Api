<?php

require_once(SRC_PAGE.'/content/users/class.User.php');

class Sign extends User {
    public function signUp($name, $email = null, $phone = null, $password, $rePassword) {
        global $pdo;
        global $response;

        if($password != $rePassword) {
            $response->success = false;
            $response->content = ["message" => "Passwords doesn't match!"]; 

            return false;
        }

        $sql = "SELECT `id`, `name`, `email`, `phone`
            FROM `users`
            WHERE `name` = ? or `email` = ? or `phone` = ?";

        $select = $pdo->prepare($sql);
        $select->bindParam(1, $name);
        $select->bindParam(2, $email);
        $select->bindParam(3, $phone);
        $select->execute();

        $userResult = $select->fetch();

        if(isset($userResult->id)) {
            $response->success = false;
            if($userResult->name == $name) {
                $response->content = ["message" => "This username already exists!"]; 

                return false;
            } else {
                $response->content = ["message" => "This email/phone is already registered!"]; 

                return false;
            }
        }   

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $sql = "INSERT INTO `users`(`name`, `email`, `phone`, `password`) VALUES (?, ?, ?, ?)";

            $insert = $pdo->prepare($sql);
            $insert->bindParam(1, $name);
            $insert->bindParam(2, $email);
            $insert->bindParam(3, $phone);
            $insert->bindParam(4, $hashedPassword);
            $insert->execute();

            $insertResult = $insert->fetch();
        } catch(PDOException $e) {
            $error = $e->getMessage();

            $response->success = false;
            $response->content = ["message" => "Error when trying to create user", "error" => $error];

            return false;
        }

        $this->setUser($name);

        $userInfos = $this->showInfos();

        $response->success = true;
        $response->content = ["message" => "User created successfully!", "user" => $userInfos]; 

        return true;
    }
}