import {scrollWidth} from "./functions";

var dialog = document.querySelector('.dialog');
var body = document.querySelector('body');

export function dialogOpen(content = null){
    dialog.style.display = 'flex';
    body.style.overflow = 'hidden';
    body.style.paddingRight = scrollWidth + 'px';
    dialog.querySelector('.dialog__content').innerHTML = '';

    if (content) dialog.querySelector('.dialog__content').append(content);

    return dialog;
}

export function dialogClose(){
    dialog.style.display = '';
    body.style.overflow = '';
    body.style.paddingRight = '';
    dialog.querySelector('.dialog__content').innerHTML = '';
}

document.addEventListener('click' , function(e){
    if (e.target == dialog) dialogClose();
    if (e.target.closest('.dialog__close')) dialogClose();
});
