import {getSiblings} from "../js/functions";

(function(){
   let tabsWrappers = document.querySelectorAll('.js-tabs-wrapper');
   if (tabsWrappers.length > 0){
    tabsWrappers.forEach(tabsWrapper => {
        tabsWrapper.querySelectorAll('.js-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                let dataBox = tab.getAttribute('data-box');
                let box = tabsWrapper.querySelector('.js-tab-box[data-tab="'+dataBox+'"]');
                
                getSiblings(tab).forEach(el => el.classList.remove('tab-active'));
                getSiblings(box).forEach(el => el.classList.remove('tab-box-active'));

                tab.classList.add('tab-active');
                box.classList.add('tab-box-active');
            })
        });
    });
   }
})()