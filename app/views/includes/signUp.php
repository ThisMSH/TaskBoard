<?php

if(isset($_POST['submit'])) {
    // Assigning the data to the variables
    $name = $_POST['name'];
    $un = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $cPwd = $_POST['confirm-password'];

    // Instantiating Sign Up Controller class
    $signUp = new signUpController($name, $un, $email, $pwd, $cPwd);

    // Running errors handler and sign up user
    $signUp->signUpUser();

    // Redirecting to the home page
    
    echo "<script>alert('You have successfully created your account.');</script>";
    echo "<script>location.href = 'http://localhost/TaskBoard/home/index';</script>";
}

