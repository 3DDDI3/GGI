<div class='input_block input_file_block'>
    <span><?= $title ?>:</span>
    <input id='image_<?= $name ?>' type='file' name='<?= $name ?>' accept='image/jpeg,image/png,image/jpg' <?php if($required) echo 'required' ?>>
    <label for='image_<?= $name ?>'>Выбрать файл</label>
</div>

<?php if (!empty($object['value'])): ?>
    <div class='admin_img_container'>
        <div class='admin_img_card'>
            <div class='card_image_block _transparent'>
                <img src='<?= $path ?>/<?= $object['value'] ?>' alt=''>
            </div>
            <div class='img_card_panel'>

                <a class='admin_open' title='Открыть' target='_blank'
                   href='<?= $path ?>/<?= $object['value'] ?>'></a>
                <!-- <button type='button' class='img_card_delete' data-id='<?= $object['id'] ?>'></button> -->
            </div>
        </div>
    </div>
<?php endif; ?>