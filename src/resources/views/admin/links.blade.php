<x-Admin.NavBar title="Пользователи" url="users" all="{{isset($all)&&$all}}">
    @include('admin.includes.menu.item', ['route'=>'admin.users.users.index', 'name'=>'Пользователи'])
    @include('admin.includes.menu.item', ['route'=>'admin.users.classes.index', 'name'=>'Классы пользователей'])
    @include('admin.includes.menu.item', ['route'=>'admin.users.admin_event_logs.index', 'name'=>'Журнал событий'])
</x-Admin.NavBar>


@include('admin.includes.menu.item', ['route'=>'admin.publications.index', 'name'=>'Издания'])
@include('admin.includes.menu.item', ['route'=>'admin.publications2.index', 'name'=>'Публикации'])
@include('admin.includes.menu.item', ['route'=>'admin.magazine.index', 'name'=>'Журнал'])
@include('admin.includes.menu.item', ['route'=>'admin.laboratories.index', 'name'=>'Лаборатории'])
@include('admin.includes.menu.item', ['route'=>'admin.subdivisions.index', 'name'=>'Подразделения'])
@include('admin.includes.menu.item', ['route'=>'admin.staff.index', 'name'=>'Сотрудники'])
@include('admin.includes.menu.item', ['route'=>'admin.departments.index', 'name'=>'Отделы'])
@include('admin.includes.menu.item', ['route'=>'admin.administration.index', 'name'=>'Администрация'])
@include('admin.includes.menu.item', ['route'=>'admin.vacancies.index', 'name'=>'Вакансии'])
@include('admin.includes.menu.item', ['route'=>'admin.courses.index', 'name'=>'Курсы'])
@include('admin.includes.menu.item', ['route'=>'admin.portfolio.index', 'name'=>'Портфолио'])
@include('admin.includes.menu.item', ['route'=>'admin.news.index', 'name'=>'Новости'])
@include('admin.includes.menu.item', ['route'=>'admin.services.index', 'name'=>'Услуги'])
@include('admin.includes.menu.item', ['route'=>'admin.documents.index', 'name'=>'Документы'])
@include('admin.includes.menu.item', ['route'=>'admin.eform.index', 'name'=>'Электронная форма обращений'])
@include('admin.includes.menu.item', ['route'=>'admin.council.index', 'name'=>'Диссертационный совет'])
@include('admin.includes.menu.item', ['route'=>'admin.formstyle.index', 'name'=>'Фирменный стиль'])
@include('admin.includes.menu.item', ['route'=>'admin.branches.index', 'name'=>'Филиалы'])
@include('admin.includes.menu.item', ['route'=>'admin.institute-objects.index', 'name'=>'Наши объекты'])

@include('admin.includes.menu.item', ['route'=>'admin.graduate.index', 'name'=>'Аспирантура'])

@include('admin.includes.menu.item', ['route'=>'admin.page.index', 'name'=>'Страницы'])
@include('admin.includes.menu.item', ['route'=>'admin.seo.index', 'name'=>'SEO'])
@include('admin.includes.menu.item', ['route'=>'admin.settings.index', 'name'=>'Настройки'])
