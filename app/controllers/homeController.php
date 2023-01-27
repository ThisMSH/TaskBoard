<?php

class homeController {
    
    public function index() {
        view::load("home");
    }

    public function dashboard() {
        view::load("dashboard");
    }

    public function signInAndUp() {
        view::load("signInUp");
    }

    public function signIn() {
        view::load("includes/signIn");
    }

    public function signUp() {
        view::load("includes/signUp");
    }

    public function logout() {
        view::load("includes/logout");
    }
    
    public function addSingleTask() {
        view::load("addTask");
    }

    public function addMultiTasks() {
        view::load("addMultiTasks");
    }
}