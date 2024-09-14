<!DOCTYPE html>
<html lang="en">
<?php
include __DIR__ . '/../layout/header.php';  // Include the header section
include __DIR__ . '/../layout/menu.php';    // Include the body section
?>
<div class="container mt-5">
    <h1>Персонал <a class="btn btn-primary" href="/employees/create" role="button">Создать</a></h1>
        <?php if (!empty($employees)){ ?>
        <!-- Responsive Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Фамилия</th>
                        <th>Должность</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Заметки</th>
                        <th>Имя руководителя</th>
                        <th>Фамилия руководителя</th>
                        <th>Должность руководителя</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= $employee->id ?></td>
                        <td><?= $employee->employee_first_name ?></td>
                        <td><?= $employee->employee_last_name ?></td>
                        <td><?= $employee->title ?></td>
                        <td><?= $employee->email ?></td>
                        <td><?= $employee->phone ?></td>
                        <td><?= $employee->notes ?></td>
                        <td><?= $employee->manager_first_name ?></td>
                        <td><?= $employee->manager_last_name ?></td>
                        <td><?= $employee->manager_title ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
</div>
<!-- Footer -->
<?php
include __DIR__ . '/../layout/footer.php';  // Include the footer section
?>
</html>