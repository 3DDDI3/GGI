import {fadeIn, fadeOut, slideToggle} from "../js/functions";


(function(){

    var html = document.querySelector('html');
    var body = document.querySelector('body');
    var header = document.querySelector('header');
    var menu = document.querySelector('.header__mobile-menu');
    var burger = document.querySelector('.header__burger');

    var isExpanded = false;

    function menuChange(){
        if (isExpanded){
            burger.classList.add('active');
            menu.style.display = 'flex';
            menu.style.opacity = 1;
            body.style.overflow = 'hidden';
            html.style.overflow = 'hidden';
            header.classList.add('header_white_links');
        } else{
            burger.classList.remove('active');
            menu.style.opacity = '';
            menu.style.display = '';
            body.style.overflow = '';
            html.style.overflow = '';
            header.style.color = '';
            header.classList.remove('header_white_links');
        }
    }

    burger.addEventListener('click' , function(){
        isExpanded = !isExpanded;
        menuChange();
    });

    document.addEventListener('click' , function(e){
        if (e.target.closest('.header__menu-item')) {
            isExpanded = false;
            menuChange();
        }
    });

    document.querySelectorAll('.js-navigation__item.navigation__item_with_group').forEach(elem => {
        let group = elem.querySelector('.js-navigation-group');
        let link = elem.querySelector('.js-navigation__link');
        let activeClass = 'navigation__item_with_group_active';

        elem.addEventListener('mouseenter', e => {
            if (window.innerWidth > 1360){
                fadeIn(group);
                elem.classList.add(activeClass);
            }
        });

        elem.addEventListener('mouseleave', e => {
            if (window.innerWidth > 1360){
                fadeOut(group);
                elem.classList.remove(activeClass);
            }
        });

        link.addEventListener('click', () => {
            slideToggle(group);
            elem.classList.toggle(activeClass);
        });
    });
    
    document.addEventListener('mousemove', e => {
        if (!e.target.closest('.navigation__item_with_group') && window.innerWidth>1360){
            document.querySelectorAll('.js-navigation__item.navigation__item_with_group').forEach(elem => {
                let group = elem.querySelector('.js-navigation-group');
                if (group.style.display == 'block')
                    fadeOut(group);
                elem.classList.remove('navigation__item_with_group_active');
            });
        }
    })
    



})();