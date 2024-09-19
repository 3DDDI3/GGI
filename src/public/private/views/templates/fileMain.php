<div class='input_block input_file_block'>
    <span><?= $title ?>:</span>
    <input id='file_<?= $name ?>' type='file' name='<?= $name ?>' accept='<?= $accept ?>' <?php if($required) echo 'required' ?>>
    <label for='file_<?= $name ?>'>Выбрать файл</label>
</div>

<?php if (!empty($object['value'])): ?>
    <div class='admin_file_container'>
        <a href='<?= $path . '/' . $object['value'] ?>' target='_blank'><?= $object['value'] ?></a>
        <button type='button' class='main_file_delete' data-id='<?= $object['id'] ?>' data-class='<?= $class ?>' data-path='<?= $path ?>'></button>
    </div>
<?php endif; ?>