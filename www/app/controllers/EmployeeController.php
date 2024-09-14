<?php

namespace app\controllers;

use core\Controller;
use app\models\EmployeeModel;

class EmployeeController extends Controller
{
    private EmployeeModel $employee;
    public function __construct() {
        $this->employee = new EmployeeModel();
    }
    public function index(): void
    {
        $this->view('employee/index', [
            'employees' => $this->employee->employees()
        ]);
    }
}