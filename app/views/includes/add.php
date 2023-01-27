<?php
session_start();
if(isset($_POST['submit'])) {
    $state = $_POST['state'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $date = $_POST['date'];
    $userID = $_SESSION['ID'];

    $addData = array("TaskName" => $name, "State" => $state, "Description" => $desc, "Date" => $date, "UserID" => $userID);

    $sendData = new tasksController();

    $sendData->insertData($addData);
}
