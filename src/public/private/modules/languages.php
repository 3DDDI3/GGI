<?php

use App\Models\Languages;
use lib\GenerateForm;

$title = 'Перевод сайта';
$add = false;
$filter = false;


if (isset($_POST['edit'])):

    unset($_POST['edit']);

    foreach ($_POST as $name => $value) {
        $bim = Languages::findByName($name);
        $bim->value = $value;
        $bim->save();
    }

    $_SESSION['notice'] = 'Изменено';
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit;

else:

    $languages = Languages::get();

    include ROOT . '/private/views/panel_header.php'; ?>

    <div class='admin_edit_block'>
        <form action='/<?= URI ?>' method='post' class='admin_edit-form'
              enctype='multipart/form-data'>

            <fieldset>
                <legend>Общие элементы</legend>
                <?= GenerateForm::makeTextarea('подробнее о нас', 'text3', $languages['text3']['value']) ?>
                <?= GenerateForm::makeTextarea('ВСЕ ПРОЕКТЫ', 'text4', $languages['text4']['value']) ?>
                <?= GenerateForm::makeTextarea('Все объекты', 'text12', $languages['text12']['value']) ?>
                <?= GenerateForm::makeTextarea('Наше портфолио', 'text5', $languages['text5']['value']) ?>
                <?= GenerateForm::makeTextarea('Есть вопросы?', 'text24', $languages['text24']['value']) ?>
                <?= GenerateForm::makeTextarea('С удовольствием вам ответим!', 'text25', $languages['text25']['value']) ?>
                <?= GenerateForm::makeTextarea('Оставьте телефон или почту для связи', 'text26', $languages['text26']['value']) ?>
                <?= GenerateForm::makeTextarea('Задайте ваш вопрос', 'text27', $languages['text27']['value']) ?>
                <?= GenerateForm::makeTextarea('Пользовательское соглашение', 'text28', $languages['text28']['value']) ?>
                <?= GenerateForm::makeTextarea('Отправить', 'text29', $languages['text29']['value']) ?>
                <?= GenerateForm::makeTextarea('Обязательно для заполнения', 'text30', $languages['text30']['value']) ?>
                <?= GenerateForm::makeTextarea('Необходимо дать согласие на обработку ваших данных', 'text31', $languages['text31']['value']) ?>
                <?= GenerateForm::makeTextarea('Москва', 'text32', $languages['text32']['value']) ?>
                <?= GenerateForm::makeTextarea('Иркутск', 'text33', $languages['text33']['value']) ?>
                <?= GenerateForm::makeTextarea('Главный офис', 'text34', $languages['text34']['value']) ?>
                <?= GenerateForm::makeTextarea('Региональный офис', 'text35', $languages['text35']['value']) ?>
                <?= GenerateForm::makeTextarea('СТБ ПРОЕКТ', 'text36', $languages['text36']['value']) ?>
                <?= GenerateForm::makeTextarea('Дизайн', 'text37', $languages['text37']['value']) ?>
                <?= GenerateForm::makeTextarea('Разработка', 'text38', $languages['text38']['value']) ?>
                <?= GenerateForm::makeTextarea('Общая почта для всех писем', 'text39', $languages['text39']['value']) ?>
                <?= GenerateForm::makeTextarea('Почта для поставщиков и заводов изготовителей', 'text40', $languages['text40']['value']) ?>
                <?= GenerateForm::makeTextarea('Почта для вакансий', 'text41', $languages['text41']['value']) ?>
                <?= GenerateForm::makeTextarea('ПРЕДЛОЖИТЬ КАНДИДАТУРУ', 'text42', $languages['text42']['value']) ?>
                <?= GenerateForm::makeTextarea('ПОДРОБНЕЕ', 'text43', $languages['text43']['value']) ?>
                <?= GenerateForm::makeTextarea('Показать ещё', 'text44', $languages['text44']['value']) ?>
                <?= GenerateForm::makeTextarea('СТАНДАРТЫ КОМПАНИИ', 'text45', $languages['text45']['value']) ?>
                <?= GenerateForm::makeTextarea('уделяем внимание деталям', 'text46', $languages['text46']['value']) ?>
                <?= GenerateForm::makeTextarea('Поиск...', 'text47', $languages['text47']['value']) ?>
                <?= GenerateForm::makeTextarea('ВСЕ УСЛУГИ', 'text48', $languages['text48']['value']) ?>
                <?= GenerateForm::makeTextarea('Смотреть видео', 'text49', $languages['text49']['value']) ?>
                <?= GenerateForm::makeTextarea('СЛЕДУЮЩИЙ ПРОЕКТ', 'text50', $languages['text50']['value']) ?>
                <?= GenerateForm::makeTextarea('ПРЕДЫДУЩИЙ ПРОЕКТ', 'text51', $languages['text51']['value']) ?>
                <?= GenerateForm::makeTextarea('Фотограф', 'text52', $languages['text52']['value']) ?>
                <?= GenerateForm::makeTextarea('общая площадь', 'text53', $languages['text53']['value']) ?>
                <?= GenerateForm::makeTextarea('площадь застройки', 'text54', $languages['text54']['value']) ?>
                <?= GenerateForm::makeTextarea('год постройки', 'text55', $languages['text55']['value']) ?>
                <?= GenerateForm::makeTextarea('Заказчик', 'text56', $languages['text56']['value']) ?>
                <?= GenerateForm::makeTextarea('Авторы', 'text57', $languages['text57']['value']) ?>
                <?= GenerateForm::makeTextarea('ПРОЕКТ', 'text58', $languages['text58']['value']) ?>
                <?= GenerateForm::makeTextarea('ПРАКТИКА', 'text59', $languages['text59']['value']) ?>
                <?= GenerateForm::makeTextarea('УСЛУГИ', 'text60', $languages['text60']['value']) ?>
                <?= GenerateForm::makeTextarea('ПОРТФОЛИО', 'text93', $languages['text93']['value']) ?>
                <?= GenerateForm::makeTextarea('Оставить заявку', 'text96', $languages['text96']['value']) ?>
                <?= GenerateForm::makeTextarea('наш блог', 'text97', $languages['text97']['value']) ?>
                <?= GenerateForm::makeTextarea('Все', 'text98', $languages['text98']['value']) ?>
                <?= GenerateForm::makeTextarea('Ничего не найдено', 'text99', $languages['text99']['value']) ?>
            </fieldset>

            <fieldset>
                <legend>Главная страница</legend>
                <?= GenerateForm::makeTextarea('', 'text1', $languages['text1']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text2', $languages['text2']['value']) ?>

                <?= GenerateForm::makeTextarea('', 'text6', $languages['text6']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text7', $languages['text7']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text8', $languages['text8']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text9', $languages['text9']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text10', $languages['text10']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text11', $languages['text11']['value']) ?>

                <?= GenerateForm::makeTextarea('', 'text13', $languages['text13']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text14', $languages['text14']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text15', $languages['text15']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text16', $languages['text16']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text17', $languages['text17']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text18', $languages['text18']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text19', $languages['text19']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text20', $languages['text20']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text21', $languages['text21']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text22', $languages['text22']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text94', $languages['text94']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text95', $languages['text95']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text23', $languages['text23']['value']) ?>
            </fieldset>


            <fieldset>
                <legend>О нас</legend>
                <?= GenerateForm::makeTextarea('', 'text61', $languages['text61']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text62', $languages['text62']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text63', $languages['text63']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text64', $languages['text64']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text65', $languages['text65']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text66', $languages['text66']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text67', $languages['text67']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text68', $languages['text68']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text69', $languages['text69']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text70', $languages['text70']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text71', $languages['text71']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text72', $languages['text72']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text73', $languages['text73']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text74', $languages['text74']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text75', $languages['text75']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text76', $languages['text76']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text77', $languages['text77']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text78', $languages['text78']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text79', $languages['text79']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text80', $languages['text80']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text81', $languages['text81']['value']) ?>
                <?= GenerateForm::makeTextbox('', 'text82', $languages['text82']['value']) ?>
                <?= GenerateForm::makeTextbox('', 'text83', $languages['text83']['value']) ?>
                <?= GenerateForm::makeTextbox('', 'text84', $languages['text84']['value']) ?>
                <?= GenerateForm::makeTextbox('', 'text85', $languages['text85']['value']) ?>
                <?= GenerateForm::makeTextbox('', 'text100', $languages['text100']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text86', $languages['text86']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text87', $languages['text87']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text88', $languages['text88']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text89', $languages['text89']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text90', $languages['text90']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text91', $languages['text91']['value']) ?>
                <?= GenerateForm::makeTextarea('', 'text92', $languages['text92']['value']) ?>
            </fieldset>

            <div class='input_block'>
                <button type='submit' name='edit'>Сохранить</button>
            </div>

        </form>
    </div>

<?php endif; ?>
