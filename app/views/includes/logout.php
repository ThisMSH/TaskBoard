<?php

session_start();
session_unset();
session_destroy();

// Redirecting to the home page
    
echo "<script>location.href = 'http://localhost/TaskBoard/home/index';</script>";
