<div class="search-checkboxes js-search-checkboxes" data-url="/{{\Request::path()}}">
    <div class="filter">
        <h2>{{$title ?? ''}}</h2>
        <form method="get" class="filter_form">
            <input type="text" name="search" class="js-search-checkboxes__search-input" placeholder="Введите название {{$title2 ?? ''}}" value="">
            <button type="button" class="js-search-checkboxes__search-button" class="blue_btn">Поиск</button>
        </form>
    </div>
    <div class="search-checkboxes__body">
        <input type="hidden" class="search-checkboxes__class" value="{{$class}}">
        <div class="search-checkboxes__items js-search-checkboxes__items">
            @include('admin.includes.search_checkboxes_items')
        </div>
    </div>
</div>
