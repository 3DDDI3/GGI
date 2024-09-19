<h1><?= $title ?></h1>

<div class='filter'>

    <?php if ($filter): ?>
        <h2>Фильтр</h2>
        <form action='<?= $_SERVER['REQUEST_URI'] ?>' method='get' class='filter_form'>
            <span>Название:</span>
            <input type='text' name='search' placeholder='Введите название' value='<?= $_GET['search'] ?? '' ?>'>
            <button type='submit' class='blue_btn'>Поиск</button>
        </form>
    <?php endif; ?>

    <?php if ($add): ?>
        <a href='?add' class='admin_add'>Добавление <?= $add ?></a>
    <?php endif; ?>

</div>

