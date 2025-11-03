<?php
namespace App\controllers;
use App\Core\controller;

class HomeController extends controller {
    public function index() {
        $data = [
            'title' => 'Home Page',
            'message' => 'Selamat datang di MVC Framework'
        ];
        
        $this->view('home.index', $data);
    }
}