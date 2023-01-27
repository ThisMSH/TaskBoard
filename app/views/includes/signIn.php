<?php

if(isset($_POST['submit'])) {
    // Assigning the data to the variables
    $user = $_POST['user'];
    $pwd = $_POST['password'];

    // Instantiating Sign In Controller class
    $signIn = new signInController($user, $pwd);

    // Running errors handler and sign In user
    $signIn->getUser();

    // Redirecting to the home page
    
    echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
}

