<?php

namespace app\controllers;

use app\models\PositionModel;
use core\Controller;
use app\models\EmployeeModel;
use core\Validation;
use JetBrains\PhpStorm\NoReturn;

class EmployeeController extends Controller
{
    private EmployeeModel $employee;
    private PositionModel $position;
    public function __construct() {
        $this->employee = new EmployeeModel();
        $this->position = new PositionModel();
    }
    public function index(): void
    {
        $this->view('employees/index', [
            'employees' => $this->employee->employeesWithManagers(),
            'managers' => $this->employee->employees(),
            'positions' => $this->position->positions()
        ]);
    }

    public function create(): void
    {
        $this->view('employees/create', [
            'managers' => $this->employee->employees(),
            'positions' => $this->position->positions()
        ]);
    }

    #[NoReturn] public function store(): void
    {
        $response['status'] = 'fail';
        $validationRules = [
            'manager_id' => ['required', 'is_numeric'],
            'position_id' => ['required', 'is_numeric'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'phone' => ['required'],
            'notes' => [],
        ];
        $data = Validation::validate($validationRules);

        if (empty($data['errors'])) {
            if ($this->employee->store($this->employee->tableName, $data['data'])) {
                $response['status'] = 'success';
            }
        } else {
            $response['errors'] = $data['errors'];
        }

        $this->json($response);
    }
}