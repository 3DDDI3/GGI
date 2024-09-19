<fieldset>
    <legend><?= $title ?></legend>

    <div class='components-container'>
        <?php foreach ($object as $component): ?>
            <div class='components-container__item'>
                <label>
                    <input type='checkbox' name='<?= $name ?>[]' value='<?= $component->id ?>' <?= (in_array($component->id, $selected)) ? 'checked': '' ?>>
                    <?= $component->name ?>
                </label>
            </div>
        <?php endforeach; ?>
    </div>

</fieldset>