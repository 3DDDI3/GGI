<div class='input_block'>
    <span><?= $title ?>:</span>

    <select name='<?= $name ?>' id=''>
        <?php if ($null): ?>
            <option value='0'><?= $nullTitle ?></option>
        <?php endif;

        if (!empty($object)):
            foreach ($object as $item): ?>
                <option value='<?= $item->id ?>' <?php if ($selectedId == $item->id) echo 'selected' ?>><?= $item->name ?></option>
            <?php endforeach;
        endif; ?>
    </select>

</div>