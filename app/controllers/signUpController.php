<?php

class signUpController extends signUpModel {
    private $name;
    private $username;
    private $password;
    private $passwordRepeat;
    private $email;

    public function __construct($name, $un, $email, $pass, $passR) {
        $this->name = trim($name);
        $this->username = trim($un);
        $this->password = $pass;
        $this->passwordRepeat = $passR;
        $this->email = trim($email);
    }

    public function signUpUser() {

        if ($this->emptyInput() == false) {
            echo "<script>alert('Please fill in all the inputs.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        if ($this->invalidName() == false) {
            echo "<script>alert('The name you entered is invalid, please enter a valid name.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        if ($this->invalidUsername() == false) {
            echo "<script>alert('The username you entered is invalid, please enter a valid name.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        if ($this->invalidEmail() == false) {
            echo "<script>alert('The E-mail you entered is invalid, please enter a valid E-mail.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        if ($this->invalidPassword() == false) {
            echo "<script>alert('The password you entered is invalid, please enter a valid password.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        if ($this->passwordMatchCheck() == false) {
            echo "<script>alert('You didn't repeat your password correctly, please try again.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        if ($this->EmailTakenCheck() == false) {
            echo "<script>alert('The E-mail is already taken.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        if ($this->UserTakenCheck() == false) {
            echo "<script>alert('The username is already taken.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        
        $this->setUser($this->name, $this->username, $this->email, $this->password);
    }

    private function emptyInput() {
        $result;
        if (empty($this->username) || empty($this->password) || empty($this->passwordRepeat) || empty($this->email)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }

    private function invalidName() {
        $result;
        if (!preg_match("/^[a-z\ ]{3,32}$/i", $this->name)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }

    private function invalidUsername() {
        $result;
        if (!preg_match("/^[a-z\d]{5,16}$/i", $this->username)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail() {
        $result;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }

    private function invalidPassword() {
        $result;
        if(!preg_match("/^(?=.*[\d])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z\d!@#$%^&*]{8,24}$/", $this->password)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatchCheck() {
        $result;
        if ($this->password !== $this->passwordRepeat) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }

    private function EmailTakenCheck() {
        $result;
        if (!$this->checkEmail($this->email)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }

    private function UserTakenCheck() {
        $result;
        if (!$this->checkUser($this->username)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }
}