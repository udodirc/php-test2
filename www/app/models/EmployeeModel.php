<?php
namespace app\models;

use core\Model;

class EmployeeModel extends Model
{
    public string $tableName = 'employees';

    public function employeesWithManagers(): array|false
    {
        $query = "SELECT e.first_name AS employee_first_name, e.last_name AS employee_last_name, e.id, e.email, e.phone, e.notes, positions.title,
        m.first_name AS manager_first_name, m.last_name AS manager_last_name, m.last_name AS manager_last_name, p.title as manager_title
        FROM employees e
        LEFT JOIN employees m ON e.manager_id = m.id
        LEFT JOIN positions ON e.position_id = positions.id
        LEFT JOIN positions p ON m.position_id = p.id;";

        return $this->fetch($query);
    }

    public function employees(): array|false
    {
        $query = "SELECT e.id, e.first_name, e.last_name, p.title
        FROM employees e
        LEFT JOIN positions p ON e.position_id = p.id";

        return $this->fetch($query);
    }
}