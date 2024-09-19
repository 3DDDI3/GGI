<footer class="footer">
    <div class="footer__container container container_fluid">
        <div class="footer__grid _flex">
            <div class="footer__primary">
                @include('includes.logo', ['class' => 'footer__logo'])
                <a href="tel:+78213233517" class="footer__phone footer__phone_mobile phone-number">+7 (812) <span class="phone-number__accent">323-35-17</span></a>
                <div class="footer__copyright">
                    {{__('Авторские права')}} (Copyright) © 2023, <br/> "{{__('Государственный гидрологический институт')}}"
                </div>
                <div class="footer__dots footer__dots_left"></div>         
            </div>
            <div class="footer__secondary">
                <div class="footer__list">
                    @if (!$pages->isEmpty())
                        @foreach ($pages as $page)
                            <div class="footer__column">
                                <a href="{{route('page', ['url' => $page->url])}}" class="footer__main-link">{{($page->{___('name')})}}</a>
                                @if (!$page->children->isEmpty() || ($page->page_code == 'services' && !empty($services)))
                                    @if ($page->page_code == 'services')
                                        @foreach ($services as $service)
                                            <a href="{{route('services.single', ['link' => $service->link])}}" class="footer__link">{{($service->{___('name')})}}</a>
                                        @endforeach
                                    @else
                                        @foreach ($page->children as $child)
                                            <a href="{{route('page', ['url' => $child->url])}}" class="footer__link">{{($child->{___('name')})}}</a>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="footer__tertiary">
                <div class="media media--footer">
                    @if ($setting->link1)
                        <a href="{{ $setting->link1 }}" class="media__item media__item--meteorf"></a>
                    @endif
                    @if ($setting->link2)
                        <a href="{{ $setting->link2 }}" class="media__item media__item--vk"></a>
                    @endif

                    <a href="tel:+78213233517" class="footer__phone footer__phone_desktop phone-number">+7 (812) <span class="phone-number__accent">323-35-17</span></a>
                </div>
                <a href="#" class="footer__button transparent-button">
                    <span class="transparent-button__left">
                        <span class="transparent-button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.1875 1.09375C13.6544 1.09375 17.2813 4.72063 17.2813 9.1875C17.2813 13.6544 13.6544 17.2813 9.1875 17.2813C4.72063 17.2813 1.09375 13.6544 1.09375 9.1875C1.09375 4.72063 4.72063 1.09375 9.1875 1.09375ZM9.1875 2.40625C5.44513 2.40625 2.40625 5.44513 2.40625 9.1875C2.40625 12.9299 5.44513 15.9688 9.1875 15.9688C12.9299 15.9688 15.9688 12.9299 15.9688 9.1875C15.9688 5.44513 12.9299 2.40625 9.1875 2.40625Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.7137 18.7863C19.9701 19.0418 19.9701 19.4583 19.7137 19.7138C19.4582 19.9702 19.0417 19.9702 18.7862 19.7138L13.9737 14.9013C13.7174 14.6458 13.7174 14.2293 13.9737 13.9738C14.2292 13.7174 14.6457 13.7174 14.9012 13.9738L19.7137 18.7863Z" fill="white"/>
                            </svg>
                        </span>
                    </span>
                    <span class="trasparent-button__right">
                        <span class="transparent-button__text">
                            {{__('Поиск по сайту')}}
                        </span>
                    </span>
                </a>
                <button type="button" class="footer__button transparent-button bvi-open">
                    <span class="transparent-button__left">
                        <span class="transparent-button__icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M12 19.7571C7.508 19.7571 3.20702 16.4522 0.368002 13.0212C-0.122627 12.4283 -0.122627 11.5675 0.368002 10.9746C1.0818 10.1119 2.57765 8.44763 4.57587 6.99311C9.60879 3.32972 14.3815 3.32266 19.4241 6.99311C21.7716 8.70183 23.632 10.9425 23.632 10.9746C24.1226 11.5675 24.1226 12.4283 23.632 13.0212C20.7934 16.4518 16.493 19.7571 12 19.7571ZM12 5.71668C7.02379 5.71668 2.71016 10.4623 1.50666 11.9168C1.46777 11.9638 1.46777 12.032 1.50666 12.0791C2.71021 13.5335 7.02379 18.2791 12 18.2791C16.9762 18.2791 21.2898 13.5335 22.4933 12.0791C22.5635 11.9942 22.4887 11.9168 22.4933 11.9168C21.2898 10.4623 16.9762 5.71668 12 5.71668Z" fill="white"/>
                                <path d="M12 17.1707C9.14774 17.1707 6.82724 14.8502 6.82724 11.998C6.82724 9.14569 9.14774 6.8252 12 6.8252C14.8523 6.8252 17.1728 9.14569 17.1728 11.998C17.1728 14.8502 14.8523 17.1707 12 17.1707ZM12 8.30313C9.96268 8.30313 8.30517 9.96063 8.30517 11.998C8.30517 14.0353 9.96268 15.6928 12 15.6928C14.0373 15.6928 15.6948 14.0353 15.6948 11.998C15.6948 9.96063 14.0373 8.30313 12 8.30313Z" fill="white"/>
                            </svg>
                        </span>
                    </span>
                    <span class="trasparent-button__right">
                        <span class="transparent-button__text">
                            {{__('Версия для слабовидящих')}}
                        </span>
                    </span>
                </button>
                <div class="footer__development">
                    <span>{{__('Разработка')}} - <a href="//visualteam.ru" target="_blank">VisualTeam</a></span>
                </div>
                <div class="footer__dots footer__dots_right"></div>
            </div>
        </div>
    </div>
    <div class="footer__blue-blur footer__blue-blur_left blue-blur"></div>
    <div class="footer__blue-blur footer__blue-blur_right blue-blur"></div>
</footer>