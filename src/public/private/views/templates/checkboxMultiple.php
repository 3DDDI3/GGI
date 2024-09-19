<div class='checkbox_block'>

    <input type='checkbox' name='<?= $name ?>[<?php if ($key) echo $key ?>]'
           id='checkbox_<?= $id ?? $name ?>' class='inp-cbx' style='display: none;'
           value='<?= $value ?>' <?php if ($checked) echo 'checked' ?>>

    <label class='cbx' for='checkbox_<?= $id ?? $name ?>'>
        <span>
            <svg width='12px' height='10px' viewbox='0 0 12 10'>
              <polyline points='1.5 6 4.5 9 10.5 1'></polyline>
            </svg>
        </span>
        <span><?= strip_tags($title) ?></span>
    </label>
</div>