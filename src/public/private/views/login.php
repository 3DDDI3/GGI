<?php require_once ROOT . '/private/views/header.php'; ?>

<main class='login_bg'>

    <div class='login_dialog'>
        <h1>Авторизация</h1>

        <form action='/admin' method='post' id='login_form'>

            <div class='input_block'>
                <span>Логин:</span>
                <input type='text' name='login'>
            </div>

            <div class='input_block'>
                <span>Пароль:</span>
                <input type='password' name='password'>
            </div>

            <div class='input_block'>
                <button type='submit' name='submit'>Войти</button>
            </div>

        </form>

    </div>

</main>

<?php require_once ROOT . '/private/views/footer.php';
