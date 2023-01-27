<?php

class tasksController extends tasksModel {

    public function getTasks($userID) {
        $tasks = $this->getAllTasks($userID);
        return $tasks;
    }

    public function insertData($data) {
        $this->insertTask($data);
    }
    
    public function addTask() {
        view::load("includes/add");
    }

    public function insertDatas($data, $n) {
        $this->insertTasks($data, $n);
    }

    public function addTasks() {
        view::load("includes/addMulti");
    }

    public function update($id) {
        $data = $this->getData($id);

        view::load("updateTask", $data);
    }

    public function updateTask($id) {
        $data = array("TaskID" => $id); 
        view::load("includes/update", $data);
    }

    public function updateData($data) {
        $this->updData($data);
    }

    public function delete($id) {
        $this->deleteTask($id);
    }

    public function deleteAll($id) {
        $this->deleteAllTasks($id);
    }
}