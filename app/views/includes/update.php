<?php
if(isset($_POST['submit'])) {
    $state = $_POST['state'];
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $date = $_POST['date'];
    $id = $view_data['TaskID'];

    $addData = array("TaskName" => $name, "State" => $state, "Description" => $desc, "Date" => $date, "TaskID" => $id);

    $sendData = new tasksController();

    $sendData->updateData($addData);
}
