<?php
namespace app\controllers;

use core\Controller;

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home');
    }
}