<div class='input_block'>
    <span><?= $title ?>:</span>
    <select name='<?= $name ?>[]' size='10' multiple>
        <?php foreach ($object as $item): ?>
            <option value='<?= $item->id ?>'
                <?php if (in_array($item->id, $selected)) echo 'selected' ?>
            ><?= $item->name ?></option>
        <?php endforeach; ?>
    </select>
    <?php if (!empty($info)): ?>
        <span class='admin-guide-msg'><?= $info ?></span>
    <?php endif; ?>
</div>