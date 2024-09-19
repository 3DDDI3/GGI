<?php

namespace lib;


class Pagination
{
    // TODO сделать просто указание количества страниц справа / слева

    // Текущая страница
    private $currentPage;

    // Сколько записей выводить на страницу ($perpage)
    private $limit;

    // Общее количество записей
    private $total;

    // Общее количество страниц (в пагинации)
    private $countPages;

    // Url адрес вместе с GET параметрами, кроме параметра с номером страницы (page)
    private $uri;

    // $currentPage - текущая страница (из $_GET)
    // $limit - сколько записей выводить (из настроек или вручную)
    // $total - общее количество записей (из БД)
    public function __construct($currentPage, $limit, $total)
    {
        $this->limit = $limit;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->setCurrentPage($currentPage);
        $this->uri = $this->getParams();
    }

    // Магический метод, срабатывает при попытке привести объект к строке (вывести через echo), должен вернуть строку
    // $obj = new Class();
    // echo $obj; (Php проверит, есть ли метод __toString, если есть, выведет то что вернет метод)
    public function __toString()
    {
        return $this->getHtml();
    }

    private function getHtml()
    {
        $next = null; // Следущая страница
        $prev = null; // Переыдущая страница
        $start = null; // Ссылка на 1 страницу
        $end = null; // Ссылка на последнюю страницу

        $page1right = null; // 1 страница справа
        $page1left = null; // 1 страница слева
        $page2right = null; // 2 страница справа
        $page2left = null; // 2 страница слева

        // Следующая страница, будет только если мы не на последней странице (текущая страница < количества страниц)
        if ($this->currentPage < $this->countPages) {
            $nextPage = $this->currentPage + 1;
            $next = "<li><a class='pagination-link' href='{$this->uri}page=$nextPage'>&gt;</a></li>";
        }

        // Предыдущая страница, будет только если мы не на 1 странице
        if ($this->currentPage > 1) {
            $prevPage = $this->currentPage - 1;
            $prev = "<li><a class='pagination-link' href='{$this->uri}page=$prevPage'>&lt;</a></li>";
        }

        // 1 страница, будет только если мы на странице > 3
        if ($this->currentPage > 3) {
            $start = "<li><a class='pagination-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }

        // Последняя страница, будет если страниц справа больше 2
        if ($this->currentPage < ($this->countPages - 2)) {
            $end = "<li><a class='pagination-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }

        if ($this->currentPage - 2 > 0) {
            $num = $this->currentPage - 2;
            $page2left = "<li><a class='pagination-link' href='{$this->uri}page=$num'>$num</a></li>";
        }

        if ($this->currentPage - 1 > 0) {
            $num = $this->currentPage - 1;
            $page1left = "<li><a class='pagination-link' href='{$this->uri}page=$num'>$num</a></li>";
        }

        if ($this->currentPage + 2 <= $this->countPages) {
            $num = $this->currentPage + 2;
            $page2right = "<li><a class='pagination-link' href='{$this->uri}page=$num'>$num</a></li>";
        }

        if ($this->currentPage + 1 <= $this->countPages) {
            $num = $this->currentPage + 1;
            $page1right = "<li><a class='pagination-link' href='{$this->uri}page=$num'>$num</a></li>";
        }

        $active = "<li class='active'><a class='pagination-link'>{$this->currentPage}</a></li>";

        $html = "<ul class='pagination'>$start $prev $page2left $page1left $active $page1right $page2right $next $end</ul>";

        return $html;
    }

    // Вернет общее количество страниц
    private function getCountPages()
    {
        // Делим 'количество записей' на 'сколько записей выводить на 1 страницу'
        // Например 5 записей, выводить по 2 записи, т.е. нужны 3 страницы, 5/2 = 2.5, ceil(2.5) = 3
        return ceil($this->total / $this->limit) ?: 1;
    }

    // Установить номер текущей страницы (из $_GET)
    private function setCurrentPage($currentPage)
    {
        // если значение < 1, приравним текущую страницу к 1
        if ($currentPage > 0) {
            // Если значение больше, чем общее количество страницу, приравним к последней страцнице
            if ($currentPage > $this->countPages) {
                $currentPage = $this->countPages;
            }

        } else {
            $currentPage = 1;
        }

        return $currentPage;
    }

    // Возвращает с какой записи начать выборку
    // SELECT * FROM `news` LIMIT 0,3 (0 - c скаой записи начать выборку, 3 - сколько записей выбрать)
    public function getStart()
    {
        // Если текущая страница 1, то (1-1) * limit = 0, т.е. начать выборку с 0 записи
        return ($this->currentPage - 1) * $this->limit;
    }

    // Создаем ссылку с GET параметрами, чтобы сохранить их при переходе на другую страницу
    private function getParams()
    {
        // Получаем url и делим по ? на uri и параметры
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);

        // Начинаем формировать uri
        $uri = $url[0] . '?';

        if (isset($url[1]) && $url[1] != '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                // Если GET параметр не содержит в себе 'page=', добавим его обратно к uri
                if (!(preg_match('#page=#', $param))) {
                    $uri .= "{$param}&amp;";
                }
            }
        }

        return $uri;
    }


}