<?php
    if (empty($_SERVER['QUERY_STRING'])) {
        header("location: http://localhost/TaskBoard/home/index");
        include "autoload.php";
    }else {
        include "autoload.php";
    }
    

