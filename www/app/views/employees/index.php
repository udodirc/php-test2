<!DOCTYPE html>
<html lang="en">
<?php
include __DIR__ . '/../layout/header.php';  // Include the header section
include __DIR__ . '/../layout/menu.php';    // Include the body section
?>
<div class="container mt-5">
    <h1>
        Персонал
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Создать
        </button>
    </h1>
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
                        <th></th>
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
                        <td><a href="#" id="editModal" data-id="<?= $employee->id ?>">Редактировать</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php } ?>
    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Создать</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <div id="response"></div>
                                <form id="add">
                                    <div class="mb-3">
                                        <label for="manager_id" class="form-label">Руководитель</label>
                                        <select id="manager_id" name="manager_id" class="form-select" aria-label="Default select example">
                                            <option selected>Выбрать</option>
                                            <?php if (!empty($managers)){ ?>
                                                <?php foreach ($managers as $manager): ?>
                                                    <option value="<?= $manager->id ?>"><?= $manager->first_name.'&nbsp'.$manager->last_name ?> - должность (<?= $manager->title ?>)</option>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
                                        <div id="manager_id_error"></div>
                                        <?php if(!empty($errors['manager_id'])) {?>
                                            <div id="manager_id_error">
                                                <?= $errors['manager_id']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="position_id" class="form-label">Должность</label>
                                        <select id="position_id" name="position_id" class="form-select" aria-label="Default select example">
                                            <option selected>Выбрать</option>
                                            <?php if (!empty($positions)){ ?>
                                                <?php foreach ($positions as $position): ?>
                                                    <option value="<?= $position->id ?>"><?= $position->title ?></option>
                                                <?php endforeach; ?>
                                            <?php } ?>
                                        </select>
                                        <div id="position_id_error"></div>
                                        <?php if(!empty($errors['position_id'])) {?>
                                            <div id="position_id_error">
                                                <?= $errors['position_id']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">Имя</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Введите имя">
                                        <div id="first_name_error"></div>
                                        <?php if(!empty($errors['first_name'])) {?>
                                            <div>
                                                <?= $errors['first_name']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Фамилия</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Введите фамилию">
                                        <div id="last_name_error"></div>
                                        <?php if(!empty($errors['last_name'])) {?>
                                            <div>
                                                <?= $errors['last_name']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Введите email">
                                        <div id="email_error"></div>
                                        <?php if(!empty($errors['email'])) {?>
                                            <div>
                                                <?= $errors['email']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Телефон</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Введите телефон">
                                        <div id="phone_error"></div>
                                        <?php if(!empty($errors['phone'])) {?>
                                            <div>
                                                <?= $errors['phone']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Заметки</label>
                                        <textarea class="form-control" id="notes" name="notes" placeholder="Введите заметку"></textarea>
                                        <div id="notes_error"></div>
                                        <?php if(!empty($errors['notes'])) {?>
                                            <div>
                                                <?= $errors['notes']; ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <input type="hidden" class="form-control" id="employee_id" name="employee_id">
                                    <button type="submit" class="btn btn-primary w-100">Создать</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#add').on('submit', function (event) {
            event.preventDefault(); // Prevent form from submitting the traditional way

            // Get form data
            var formData = $(this).serialize(); // Serialize form data (name=value)

            // AJAX request
            $.ajax({
                url: '/employees/store',       // Server script to process data
                type: 'POST',             // HTTP method
                data: formData,           // Data being sent to server
                success: function (response) {
                    if (response.status === 'success') {
                        window.location.replace("/employees");
                    } else {
                        for (const [key, value] of Object.entries(response.errors)) {
                            $('#' + key + '_error').html('<p>' + value + '</p>');
                        }
                    }
                },
                error: function (xhr, status, error) {
                    // On error, show an error message
                    $('#response').html('An error occurred: ' + error);
                }
            });
        });
    });

    $(document).on('click', '#editModal', function() {
        let dataId = $(this).data('id');
        // Send AJAX request to fetch data
        $.ajax({
            url: '/employees/edit',  // The URL to your backend endpoint
            type: 'POST',       // Request type (GET or POST)
            data: { id: dataId }, // Data to send to the server (e.g., the id)
            success: function(response) {
                if(response.data[0]){
                    $('#employee_id').val(dataId);
                    // Inject response data into the modal's content area
                    for (const [key, value] of Object.entries(response.data[0])) {
                        $('#' + key).val(value);
                    }
                    let addModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('addModal')) // Returns a Bootstrap modal instance

                    addModal.show();
                }
            },
            error: function() {
                $('#modalContent').html('Error loading data.');
            }
        });
    });
</script>
<!-- Footer -->
<?php
include __DIR__ . '/../layout/footer.php';  // Include the footer section
?>
</html>