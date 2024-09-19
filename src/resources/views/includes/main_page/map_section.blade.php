<div class="section section_map">
    <div class="section_map__header">
        <div class="section_map__header-container container container_1400">
            <div class="section_map__header-grid _flex">
                <h2 class="section_map__title page-title page-title_white">{{__('Наши объекты')}}</h2>
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="40" viewBox="0 0 28 40" fill="none">
                    <g clip-path="url(#clip0_16_1219)">
                    <path d="M16.9902 0.077877C11.7951 -1.2865 2.80716 1.88741 0.723675 8.35277C-0.509969 12.1973 0.112728 15.8684 1.70276 19.4393C3.22817 22.8695 5.55055 25.7987 7.72608 28.8338C10.2208 32.3161 12.6215 35.8561 14.0196 40.2344C15.7076 34.7654 19.0736 30.5219 22.2439 26.1552C24.0728 23.6365 25.8411 21.0792 26.9083 18.125C29.9865 9.57262 25.9331 2.41543 16.9902 0.077877ZM14.1959 17.5276C13.2861 17.5276 12.3968 17.2621 11.6404 16.7647C10.884 16.2673 10.2944 15.5603 9.94626 14.7332C9.59811 13.906 9.50702 12.9959 9.6845 12.1178C9.86199 11.2397 10.3001 10.4331 10.9434 9.80003C11.5866 9.16695 12.4062 8.73582 13.2985 8.56116C14.1908 8.3865 15.1156 8.47614 15.9561 8.81876C16.7966 9.16137 17.515 9.74157 18.0204 10.486C18.5258 11.2304 18.7956 12.1056 18.7956 13.0009C18.7956 14.2015 18.311 15.3528 17.4484 16.2018C16.5857 17.0507 15.4158 17.5276 14.1959 17.5276Z" fill="#29B3FF"/>
                    </g>
                    <defs>
                    <clipPath id="clip0_16_1219">
                    <rect width="28" height="40" fill="white"/>
                    </clipPath>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
    <div class="section_map__map map js-map" id="objects-map"></div>
</div>


<script type="text/javascript" src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=65f27bd8-fc4e-4af1-a1e4-4427f8dc3a8b"></script>
<script type="text/javascript" src="{{asset('/js/ymaps.js')}}"></script>
