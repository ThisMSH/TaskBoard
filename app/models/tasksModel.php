<?php

class tasksModel extends DB {

    protected function getAllTasks($userID) {
        $stmt = $this->conn()->prepare("SELECT * FROM tasks WHERE UserID = ?;");
        $stmt->execute(array($userID));
        return $stmt->fetchAll();
        $stmt = null;
    }

    protected function insertTask($data) {
        $stmt = $this->conn()->prepare("INSERT INTO tasks (UserID, Title, Description, Deadline, State) VALUES (?, ?, ?, ?, ?);");

        if(empty($data['TaskName'])) {
            echo "<script>alert('Please add a title to the task.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
            exit();
        }

        if(!$stmt->execute(array($data["UserID"], $data["TaskName"], $data["Description"], $data["Date"], $data["State"]))) {
            $stmt = null;
            echo "<script>alert('Add task statement failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
            exit();
        }

        $stmt = null;
        echo "<script>alert('A new task has been added successfully.');</script>";
        echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
    }

    protected function insertTasks($data, $n) {
        $stmt = $this->conn()->prepare("INSERT INTO tasks (UserID, Title, Description, Deadline, State) VALUES (?, ?, ?, ?, ?);");

        for($i = 0; $i < $n; $i++) {
            if(!$stmt->execute(array($data["UserID"], $data["TaskName"][$i], $data["Description"][$i], $data["Date"][$i], $data["State"][$i]))) {
                $stmt = null;
                echo "<script>alert('Add multiple task statement failed.');</script>";
                echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
                exit();
            }
        }

        $stmt = null;
        echo "<script>alert('All the tasks have been added successfully.');</script>";
        echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
    }

    protected function getData($id) {
        $stmt = $this->conn()->prepare("SELECT * FROM tasks WHERE TaskID = ?;");
        if($stmt->execute(array($id))) {
            return $stmt->fetchAll();
        }else {
            echo "<script>alert('Data not found about this task.');</script>";
        }
        
        $stmt = null;
    }

    protected function updData($data) {
        $stmt = $this->conn()->prepare("UPDATE tasks SET Title = ?, Description = ?, Deadline = ?, State = ? WHERE TaskID = ?;");

        if(!$stmt->execute(array($data["TaskName"], $data["Description"], $data["Date"], $data["State"], $data["TaskID"]))) {
            $stmt = null;
            echo "<script>alert('Statement failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
            exit();
        }

        $stmt = null;
        echo "<script>alert('A new tour destination has been updated successfully.');</script>";
        echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
    }

    protected function deleteTask($id) {
        $deleteData = $this->conn()->prepare("DELETE FROM tasks WHERE TaskID = ?;");
        if(!$deleteData->execute(array($id))) {
            $deleteData = null;
            echo "<script>alert('Delete statement failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
            exit();
        }

        $deleteData = null;
        echo "<script>alert('The task has been deleted successfully.');</script>";
        echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
    }

    protected function deleteAllTasks($id) {
        $deleteData = $this->conn()->prepare("DELETE FROM tasks WHERE UserID = ?;");
        if(!$deleteData->execute(array($id))) {
            $deleteData = null;
            echo "<script>alert('Delete statement failed.');</script>";
            echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
            exit();
        }

        $deleteData = null;
        echo "<script>alert('ALL The tasks have been deleted successfully.');</script>";
        echo "<script>location.href = 'http://localhost/TaskBoard/home/dashboard';</script>";
    }
}
