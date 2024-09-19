<?php

use App\Models\Requests as Model;

$title = 'Заявки';
$add = false;
$filter = false;

$uri = URI;

if (isset($_GET['delete'])):

    $object = Model::findById($_GET['delete']);

    if ($object) {
        $object->delete();
    }

    $_SESSION['notice'] = 'Удалено';

    header("Location: /$uri");
    exit;

else:

    include ROOT . '/private/views/panel_header.php';

    $objects = Model::findAll([], ['id' => 'DESC']);

    if (!empty($objects)): ?>
        <table class='request-table table_dark'>

            <thead>
                <tr>
                    <th>№</th>
                    <th>Тип завяки:</th>
                    <th>Дата:</th>
                    <th>Страница:</th>
                    <th>Имя:</th>
                    <th>E-mail:</th>
                    <th>Телефон:</th>
                    <th>Сообщение:</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($objects as $object): ?>
                    <tr>
                        <td><?= $object->id ?></td>
                        <td><?= $object->type ?></td>
                        <td><?= date('d.m.Y H:i:s', $object->date) ?></td>
                        <td><a href='<?= $object->page ?>' target='_blank'>Перейти</a></td>
                        <td><?= $object->name ?: '&mdash;' ?></td>
                        <td><?= $object->email ?: '&mdash;' ?></td>
                        <td><?= $object->phone ?: '&mdash;' ?></td>
                        <td><?= $object->message ?: '&mdash;' ?></td>
                        <td><a href='?delete=<?= $object->id ?>' class='admin_delete' title='Удалить'></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <div class='not_found'>Ничего не найдено</div>
    <?php endif;

endif;
