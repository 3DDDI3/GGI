
function initMap(mapSelector, arr, enablebBalloon=true, enableHover=true){
    ymaps.ready(function () {

        var balloon = null;
        if (enablebBalloon)
            balloon = ymaps.templateLayoutFactory.createClass(
            /*html*/
            `<div class="map__balloon balloon js-balloon">
                <div class="balloon__container">
                    <div class="balloon__location">$[properties.balloonLocation]</div>
                    <div class="balloon__title">$[properties.balloonTitle]</div>
                    <div class="balloon__text">$[properties.balloonText]</div>
                    <a href="$[properties.balloonLink]" class="balloon__link">{{__('Подробнее')}}</a>
                </div>
            </div>`, {

            //Формирование макета
            build: function () {
                this.constructor.superclass.build.call(this);
                
                this._element = this.getParentElement().querySelector('.js-balloon');
                
                this.applyElementOffset();

                // this._element.querySelector('.js-balloon__close')
                //     .addEventListener('click', $.proxy(this.onCloseClick, this));
            },
            //удаление макета из DOM
            clear: function () {
                // this._$element.find('.js-balloon__close')
                //     .off('click');

                this.constructor.superclass.clear.call(this);
            },
            //закрытие балуна
            onCloseClick: function (e) {
                e.preventDefault();

                this.events.fire('userclose');
            },

            applyElementOffset: function () {
                this._element.style.left = (this._element.offsetWidth / 2)+'px';
                this._element.style.top = (this._element.offsetHeight)+'px';
                
        }
        }
        );

        var icon=null;
        if (enableHover)
            icon = ymaps.templateLayoutFactory.createClass(
                '<svg class="map__icon js-map__icon" xmlns="http://www.w3.org/2000/svg" width="28" height="40" viewBox="0 0 28 40" fill="none"><g clip-path="url(#clip0_16_1202)"><path d="M16.9902 0.077877C11.7951 -1.2865 2.80716 1.88741 0.723675 8.35277C-0.509969 12.1973 0.112728 15.8684 1.70276 19.4393C3.22817 22.8695 5.55055 25.7987 7.72608 28.8338C10.2208 32.3161 12.6215 35.8561 14.0196 40.2344C15.7076 34.7654 19.0736 30.5219 22.2439 26.1552C24.0728 23.6365 25.8411 21.0792 26.9083 18.125C29.9865 9.57262 25.9331 2.41543 16.9902 0.077877ZM14.1959 17.5276C13.2861 17.5276 12.3968 17.2621 11.6404 16.7647C10.884 16.2673 10.2944 15.5603 9.94626 14.7332C9.59811 13.906 9.50702 12.9959 9.6845 12.1178C9.86199 11.2397 10.3001 10.4331 10.9434 9.80003C11.5866 9.16695 12.4062 8.73582 13.2985 8.56116C14.1908 8.3865 15.1156 8.47614 15.9561 8.81876C16.7966 9.16137 17.515 9.74157 18.0204 10.486C18.5258 11.2304 18.7956 12.1056 18.7956 13.0009C18.7956 14.2015 18.311 15.3528 17.4484 16.2018C16.5857 17.0507 15.4158 17.5276 14.1959 17.5276Z" fill="#525968"/></g><defs><clipPath id="clip0_16_1202"><rect width="28" height="40" fill="white"/></clipPath></defs></svg>'
            );

        var iconHover = ymaps.templateLayoutFactory.createClass(
            '<svg class="map__icon js-map__icon"  xmlns="http://www.w3.org/2000/svg" width="28" height="40" viewBox="0 0 28 40" fill="none"><g clip-path="url(#clip0_16_1185)"><path d="M16.9902 0.077877C11.7951 -1.2865 2.80716 1.88741 0.723675 8.35277C-0.509969 12.1973 0.112728 15.8684 1.70276 19.4393C3.22817 22.8695 5.55055 25.7987 7.72608 28.8338C10.2208 32.3161 12.6215 35.8561 14.0196 40.2344C15.7076 34.7654 19.0736 30.5219 22.2439 26.1552C24.0728 23.6365 25.8411 21.0792 26.9083 18.125C29.9865 9.57262 25.9331 2.41543 16.9902 0.077877ZM14.1959 17.5276C13.2861 17.5276 12.3968 17.2621 11.6404 16.7647C10.884 16.2673 10.2944 15.5603 9.94626 14.7332C9.59811 13.906 9.50702 12.9959 9.6845 12.1178C9.86199 11.2397 10.3001 10.4331 10.9434 9.80003C11.5866 9.16695 12.4062 8.73582 13.2985 8.56116C14.1908 8.3865 15.1156 8.47614 15.9561 8.81876C16.7966 9.16137 17.515 9.74157 18.0204 10.486C18.5258 11.2304 18.7956 12.1056 18.7956 13.0009C18.7956 14.2015 18.311 15.3528 17.4484 16.2018C16.5857 17.0507 15.4158 17.5276 14.1959 17.5276Z" fill="#29B3FF"/></g><defs><clipPath id="clip0_16_1185"><rect width="28" height="40" fill="white"/></clipPath></defs></svg>'
        );

        var myMap = new ymaps.Map(mapSelector, {
            center: [55.76, 37.64],
            zoom: 4,
            controls: ['fullscreenControl']
        }, {suppressMapOpenBlock: true});

        ymaps.option.presetStorage.add('mark#icon', {
            iconContentLayout: icon || iconHover,
            iconLayout: 'default#imageWithContent',

            iconImageSize: [28, 40],
            iconImageOffset: [-14, -20],

            balloonShadow: true,
            balloonLayout: balloon,
            // Запретим замену обычного балуна на балун-панель.
            // Если не указывать эту опцию, на картах маленького размера откроется балун-панель.
            balloonPanelMaxMapArea: 1
        });

        ymaps.option.presetStorage.add('mark-hover#icon', {
            iconContentLayout: iconHover,
            iconLayout: 'default#imageWithContent',

            iconImageSize: [28, 40],
            iconImageOffset: [-14, -20],
    //      hideIconOnBalloonOpen: false,

            balloonShadow: true,
            balloonLayout: balloon,
            // Запретим замену обычного балуна на балун-панель.
            // Если не указывать эту опцию, на картах маленького размера откроется балун-панель.
            balloonPanelMaxMapArea: 1
        });

        function getData() {
            return {
            "type": "FeatureCollection",
            "features": arr
        }
        }

        let objectManager = new ymaps.ObjectManager({
            clusterize: true
        });

        objectManager.add(getData());

        myMap.geoObjects.add(objectManager);

        if (enablebBalloon){
            objectManager.events.add(['click'], function(e) {
                    objectManager.objects.getAll().forEach(function(obj){
                        if(obj.id === e.get('objectId')) {
                            var state = myMap.action.getCurrentState();
                            myMap.setCenter(obj.geometry.coordinates,state.zoom, {duration: 1000});

                        }
                        objectManager.objects.setObjectOptions(obj.id, {preset: 'mark#icon'});
                    });
                    objectManager.objects.setObjectOptions(e.get('objectId'), {
                        preset: 'mark-hover#icon'
                    });
                    // myMap.balloon.close();

                });
                
            myMap.events.add('click', function() {
                myMap.balloon.close();

            //     var objects = objectManager.objects.getAll();
            //     if (objects.length>0){
            //         objects.forEach(function(obj){objectManager.objects.setObjectOptions(obj.id, {preset: 'mark#icon'});});
            //     }
            });
        }  

    });
}