import { slideUp, slideDown, getSiblings } from "../js/functions";

(function(){
    let accordions = document.querySelectorAll('.js-accordion')
    const activeClass = 'accordion__item_active';

    accordions.forEach(accordion => {
        let items = accordion.querySelectorAll('.js-accordion__item');
        items.forEach(item => {
            let button = item.querySelector('.js-accordion__head');
            let body = item.querySelector('.js-accordion__body');
            button.addEventListener('click', e => {
                if (item.classList.contains(activeClass)){
                    slideUp(body);
                    item.classList.remove(activeClass)
                }
                else{
                    let siblings = getSiblings(button.closest('.js-accordion__item'));
                    if (siblings.length > 0){
                        siblings.forEach(sibling => {
                            slideUp(sibling.querySelector('.js-accordion__body'));
                            sibling.classList.remove(activeClass);
                        }); 
                    }
                    slideDown(body);
                    item.classList.add(activeClass);
                }
            });
        })
    });
})();