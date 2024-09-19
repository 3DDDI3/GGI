<li class="navigation__item js-navigation__item @if (isset($group) && is_array($group)) navigation__item_with_group @endif">
    <div class="navigation__link-wrapper">
        <a href="{{ $link }}" class="navigation__link js-navigation__link">{{ $name }}</a>
        <svg class="navigation__arrow" xmlns="http://www.w3.org/2000/svg" width="9" height="9" viewBox="0 0 9 9"
            fill="none">
            <path
                d="M4.49998 7.06507C4.33868 7.06507 4.1774 7.00348 4.05442 6.88057L0.184627 3.01073C-0.0615424 2.76456 -0.0615424 2.36544 0.184627 2.11937C0.430697 1.8733 0.829739 1.8733 1.07593 2.11937L4.49998 5.54361L7.92404 2.11949C8.17021 1.87342 8.56921 1.87342 8.81526 2.11949C9.06155 2.36556 9.06155 2.76468 8.81526 3.01085L4.94553 6.88068C4.82249 7.00362 4.66121 7.06507 4.49998 7.06507Z"
                fill="#363434" />
        </svg>
    </div>
    @if (isset($group) && is_array($group))
        <ul class="navigation__group navigation-group js-navigation-group clear-list">
            @foreach ($group as $group_item)
                @if ($group_item['name'])
                    <li class="navigation-group__item">
                        <a href="{{ $group_item['link'] }}" class="navigation-group__link">{{ $group_item['name'] }}</a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
</li>
