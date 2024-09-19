<header class="header {{ $class ?? '' }}">
    <div class="header__container container container_fluid">
        <div class="header__grid _flex">
            @include('includes.logo', ['class' => 'header__logo'])
            <div class="header__mobile-menu">
                <div class="header__mobile-menu-content">
                    <nav class="header__navigation navigation">
                        <ul class="navigation__list clear-list">
                            @if (!$pages->isEmpty())
                                @foreach ($pages as $page)
                                    @if ($page && $page->{___('name')})
                                        <li
                                            class="navigation__item js-navigation__item @if (!$page->children->isEmpty()) navigation__item_with_group @endif">
                                            <div class="navigation__link-wrapper">
                                                @if ($page->url == 'contacts')
                                                <a href="{{ route('page', ['url' => $page->url]) }}"
                                                    class="navigation__link js-navigation__link">{{ $page->{___('name')} }}</a>
                                                @else
                                                <a class="navigation__link js-navigation__link">{{ $page->{___('name')} }}</a>
                                                @endif
                                                @if (!$page->children->isEmpty())
                                                    <svg class="navigation__arrow" xmlns="http://www.w3.org/2000/svg"
                                                        width="9" height="9" viewBox="0 0 9 9" fill="none">
                                                        <path
                                                            d="M4.49998 7.06507C4.33868 7.06507 4.1774 7.00348 4.05442 6.88057L0.184627 3.01073C-0.0615424 2.76456 -0.0615424 2.36544 0.184627 2.11937C0.430697 1.8733 0.829739 1.8733 1.07593 2.11937L4.49998 5.54361L7.92404 2.11949C8.17021 1.87342 8.56921 1.87342 8.81526 2.11949C9.06155 2.36556 9.06155 2.76468 8.81526 3.01085L4.94553 6.88068C4.82249 7.00362 4.66121 7.06507 4.49998 7.06507Z"
                                                            fill="#363434" />
                                                    </svg>
                                                @endif
                                            </div>
                                            @if (!$page->children->isEmpty() || ($page->page_code == 'services' && !empty($services)))
                                                <ul
                                                    class="navigation__group navigation-group js-navigation-group clear-list">

                                                    @if ($page->page_code == 'services')
                                                        @foreach ($services as $service)
                                                            @if ($service->{___('name')})
                                                                <li class="navigation-group__item">
                                                                    <a href="{{ route('services.single', ['link' => $service->link]) }}"
                                                                        class="navigation-group__link">{{ $service->{___('name')} }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        @foreach ($page->children as $child)
                                                            @if ($child->{___('name')})
                                                                <li class="navigation-group__item">
                                                                    <a href="{{ route('page', ['url' => $child->url]) }}"
                                                                        class="navigation-group__link">{{ $child->{___('name')} }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                    <div class="header__end">
                        <div class="media">
                            @if ($setting->link1)
                                <a href="{{ $setting->link1 }}" class="media__item media__item--meteorf"></a>
                            @endif
                            @if ($setting->link2)
                                <a href="{{ $setting->link2 }}" class="media__item media__item--vk"></a>
                            @endif

                        </div>
                        <a href="tel:+78213233517" class="header__phone phone-number">+7 (812) <span
                                class="phone-number__accent">323-35-17</span></a>

                        <div class='header-search-block'>
                            <button type='button' class='search-form-active-btn header__search-button'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21"
                                    viewBox="0 0 21 21" fill="none">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.1875 1.09375C13.6544 1.09375 17.2813 4.72063 17.2813 9.1875C17.2813 13.6544 13.6544 17.2813 9.1875 17.2813C4.72063 17.2813 1.09375 13.6544 1.09375 9.1875C1.09375 4.72063 4.72063 1.09375 9.1875 1.09375ZM9.1875 2.40625C5.44513 2.40625 2.40625 5.44513 2.40625 9.1875C2.40625 12.9299 5.44513 15.9688 9.1875 15.9688C12.9299 15.9688 15.9688 12.9299 15.9688 9.1875C15.9688 5.44513 12.9299 2.40625 9.1875 2.40625Z"
                                        fill="white" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M19.7137 18.7862C19.9701 19.0417 19.9701 19.4582 19.7137 19.7137C19.4582 19.9701 19.0417 19.9701 18.7862 19.7137L13.9737 14.9012C13.7174 14.6457 13.7174 14.2292 13.9737 13.9737C14.2292 13.7174 14.6457 13.7174 14.9012 13.9737L19.7137 18.7862Z"
                                        fill="white" />
                                </svg>
                            </button>

                            <div class='search-form-container'>
                                <form action='/search' method='post' class='search-from'>
                                    @csrf
                                    <input type='text' name='query' placeholder='Поиск'>
                                </form>
                                <button type='button' class='close-btn search-from-close-btn'></button>
                            </div>
                        </div>


                        <div class="header__language">
                            <a href="{{ (\Request::path() != '/' ? '/' . \Request::path() : '/') . '?language=ru' }}"
                                class="header__language-link {{ session()->get('language') == 'ru' || !session()->get('language') ? 'header__language-link_active' : '' }}">RU</a>
                            <a href="{{ (\Request::path() != '/' ? '/' . \Request::path() : '/') . '?language=en' }}"
                                class="header__language-link {{ session()->get('language') == 'en' ? 'header__language-link_active' : '' }}">EN</a>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="header__burger">
                <div class="header__burger-line"></div>
            </button>
        </div>
        @if (url()->current() == '/')
            <div class="header__blue-blur blue-blur"></div>
        @endif
    </div>
</header>
