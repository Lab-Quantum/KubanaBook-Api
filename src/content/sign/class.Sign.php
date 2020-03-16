<?php

require_once(SRC_PAGE.'/content/users/class.User.php');

class Sign extends User {
    public function signIn($user, $password) {
        global $pdo;
        global $response;

        $sql = "SELECT `id`, `name`, `password` 
            FROM `users` 
            WHERE `name` = ? or `email` = ? or `phone` = ?";

        $select = $pdo->prepare($sql);
        $select->bindParam(1, $user);
        $select->bindParam(2, $user);
        $select->bindParam(3, $user);
        $select->execute();

        $userResult = $select->fetch();

        if(!isset($userResult->id)) {
            $response->success = false;
            $response->content = ["message" => "User not found"]; 

            return false;
        } elseif(!password_verify($password, $userResult->password)) {
            $response->success = false;
            $response->content = ["message" => "User and password doesn't match"]; 

            return false;
        } else {
            $this->setUser($userResult->id);

            $token = $this->generateHashToken($userResult->id);
            $userInfos = $this->showInfos();
            
            $_SESSION['token'] = $token;

            $response->success = true;
            $response->content = [
                "message" => "Successfully sign in",
                "user"  => $userInfos,
                "token" => $token
            ];
        }
    }

    public function signUp($name, $email = null, $phone = null, $password, $rePassword) {
        global $pdo;
        global $response;

        if($password != $rePassword) {
            $response->success = false;
            $response->content = ["message" => "Passwords doesn't match!"]; 

            return false;
        } if(strlen($name) < 3) {
            $response->success = false;
            $response->content = ["message" => "The name must have at last 3 characters"]; 

            return false;
        }

        if(!empty($email) && !$this->verifyEmail($email)) {
            return false;
        }

        if(!empty($phone) && !$this->verifyPhone($phone)) {
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