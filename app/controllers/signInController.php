<?php

class signInController extends signInModel {
    private $user;
    private $password;

    public function __construct($user, $pass) {
        $this->user = $user;
        $this->password = $pass;
    }

    
    public function getUser() {
        if ($this->emptyInput() == false) {
            echo "<script>alert('Please fill in all the inputs.');</script>"; 
            echo "<script>location.href = 'http://localhost/TaskBoard/home/signInAndUp';</script>";
            exit();
        }
        $this->signInUser($this->user, $this->password);
    }

    private function emptyInput() {
        $result;
        if (empty($this->user) || empty($this->password)) {
            $result = false;
        }else {
            $result = true;
        }
        return $result;
    }
}