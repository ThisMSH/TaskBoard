<?php

class signUpModel extends DB {
    protected function setUser($name, $username, $email, $password) {
        $stmt = $this->conn()->prepare("INSERT INTO users (Name, UserName, Email, Password) VALUES (?, ?, ?, ?);");

        $hashingPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($name, $username, $email, $hashingPassword))) {
            $stmt = null;
            echo "<script>alert('Set a new user statement failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/login';</script>";
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($username) {
        $stmt = $this->conn()->prepare("SELECT ID FROM users WHERE UserName = :username;");
        $stmt->bindParam(":username", $username);

        if (!$stmt->execute()) {
            $stmt = null;
            echo "<script>alert('Username check statement failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/login';</script>";
            exit();
        }

        $resultCheck;

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    protected function checkEmail($email) {
        $stmt = $this->conn()->prepare("SELECT ID FROM users WHERE Email = ?;");

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            echo "<script>alert('E-mail check statement failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/login';</script>";
            exit();
        }

        $resultCheck;

        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}