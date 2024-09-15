<!DOCTYPE html>
<html lang="en">
<?php
include __DIR__ . '/../layout/header.php';  // Include the header section
include __DIR__ . '/../layout/menu.php';    // Include the body section
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form action="/employees/store" method="post" enctype="multipart/form-data">
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
                    <?php if(!empty($errors['manager_id'])) {?>
                        <div>
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
                    <?php if(!empty($errors['position_id'])) {?>
                        <div>
                            <?= $errors['position_id']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="first_name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Введите имя">
                    <?php if(!empty($errors['first_name'])) {?>
                        <div>
                            <?= $errors['first_name']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Введите фамилию">
                    <?php if(!empty($errors['last_name'])) {?>
                        <div>
                            <?= $errors['last_name']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Введите email">
                    <?php if(!empty($errors['email'])) {?>
                        <div>
                            <?= $errors['email']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Введите телефон">
                    <?php if(!empty($errors['phone'])) {?>
                        <div>
                            <?= $errors['phone']; ?>
                        </div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Заметки</label>
                    <textarea class="form-control" id="notes" name="notes" placeholder="Введите заметку"></textarea>
                    <?php if(!empty($errors['notes'])) {?>
                        <div>
                            <?= $errors['notes']; ?>
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary w-100">Создать</button>
            </form>
        </div>
    </div>
</div>
<!-- Footer -->
<?php
include __DIR__ . '/../layout/footer.php';  // Include the footer section
?>
</html>