<?php

class signInModel extends DB {

    protected function signInUser($user, $password) {
        $stmt = $this->conn()->prepare("SELECT Password FROM users WHERE Username = ? OR Email = ?;");

        if (!$stmt->execute(array($user, $user))) {
            $stmt = null;
            echo "<script>alert('Statement 1 failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            echo "<script>alert('User not found.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }

        $hashedPassword = $stmt->fetch(PDO::FETCH_ASSOC);
        $checkingPassword = password_verify($password, $hashedPassword["Password"]);

        if ($checkingPassword == false) {
            $stmt = null;
            echo "<script>alert('The password is wrong.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }elseif ($checkingPassword == true) {
            $stmt = $this->conn()->prepare("SELECT * FROM users WHERE UserName = ? OR Email = ?;");

            if (!$stmt->execute(array($user, $user))) {
                $stmt = null;
                echo "<script>alert('Statement failed.');</script>";
                echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
                exit();
            }

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                echo "<script>alert('User not found.');</script>"; 
                echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
                exit();
            }

            $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['ID'] = $userInfo["ID"];
            $_SESSION['name'] = $userInfo["Name"];
            $_SESSION['username'] = $userInfo["Username"];
        }
        $stmt = null;
    }
}