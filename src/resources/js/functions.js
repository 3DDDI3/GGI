export function getOffset(el) {
    el = el.getBoundingClientRect();
    return {
        left: el.left + window.scrollX,
        top: el.top + window.scrollY
    }
}

var div = document.createElement('div');
div.style.overflowY = 'scroll';
div.style.width = '50px';
div.style.height = '50px';
document.body.append(div);
export var scrollWidth = div.offsetWidth - div.clientWidth;
div.remove();

export function makeAnimation(el, name) {
    function enter() {
        el.style.display = "block";
        el.classList.add(`${name}-enter-from`);
        el.classList.add(`${name}-enter-active`);
        el.classList.add(`${name}-enter-to`);
        el.classList.remove(`${name}-enter-from`);
        const onEnd = (e) => {
            if (e.target === el) {
                el.classList.remove(`${name}-enter-active`);
                el.classList.remove(`${name}-enter-to`);
                el.removeEventListener("animationend", onEnd);
            }
        };
        el.addEventListener("animationend", onEnd);

    }

    function leave() {
        el.classList.add(`${name}-leave-from`);
        el.classList.add(`${name}-leave-active`);
        (function(){
            el.classList.add(`${name}-leave-to`);
            el.classList.remove(`${name}-leave-from`);
            const onEnd = (e) => {
                if (e.target === el) {
                    el.classList.remove(`${name}-leave-active`);
                    el.classList.remove(`${name}-leave-to`);
                    el.removeEventListener("animationend", onEnd);
                    el.style.display = "none";
                }
            };
            el.addEventListener("animationend", onEnd);
        })();
    }

    return {
        enter,
        leave
    };
}

export function fadeOut(el) { el.style.opacity = 1; (function fade() { if ((el.style.opacity -= .1) < 0) { el.style.display = "none"; } else { requestAnimationFrame(fade); } })(); };
export function fadeIn(el, display) { el.style.opacity = 0; el.style.display = display || "block"; (function fade() { var val = parseFloat(el.style.opacity); if (!((val += .1) > 1)) { el.style.opacity = val; requestAnimationFrame(fade); } })(); };

export function slideUp(target, duration=500){
    target.style.transitionProperty = 'height, margin, padding';
    target.style.transitionDuration = duration + 'ms';
    target.style.boxSizing = 'border-box';
    target.style.height = target.offsetHeight + 'px';
    target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    window.setTimeout( () => {
      target.style.display = 'none';
      target.style.removeProperty('height');
      target.style.removeProperty('padding-top');
      target.style.removeProperty('padding-bottom');
      target.style.removeProperty('margin-top');
      target.style.removeProperty('margin-bottom');
      target.style.removeProperty('overflow');
      target.style.removeProperty('transition-duration');
      target.style.removeProperty('transition-property');
      //alert("!");
    }, duration);
  }

  export function slideDown (target, duration=500){
    target.style.removeProperty('display');
    let display = window.getComputedStyle(target).display;

    if (display === 'none')
      display = 'block';

    target.style.display = display;
    let height = target.offsetHeight;
    target.style.overflow = 'hidden';
    target.style.height = 0;
    target.style.paddingTop = 0;
    target.style.paddingBottom = 0;
    target.style.marginTop = 0;
    target.style.marginBottom = 0;
    target.offsetHeight;
    target.style.boxSizing = 'border-box';
    target.style.transitionProperty = "height, margin, padding";
    target.style.transitionDuration = duration + 'ms';
    target.style.height = height + 'px';
    target.style.removeProperty('padding-top');
    target.style.removeProperty('padding-bottom');
    target.style.removeProperty('margin-top');
    target.style.removeProperty('margin-bottom');
    window.setTimeout( () => {
      target.style.removeProperty('height');
      target.style.removeProperty('overflow');
      target.style.removeProperty('transition-duration');
      target.style.removeProperty('transition-property');
    }, duration);
  }
  export function  slideToggle (target, duration = 500){
    if (window.getComputedStyle(target).display === 'none') {
      return slideDown(target, duration);
    } else {
      return slideUp(target, duration);
    }
  }

export function onClickOutside(ele, cb) {
    document.addEventListener('click', event => {
        if (!ele.contains(event.target)) cb();
    });
}

export function isHidden(el) {
    return (el.offsetParent === null);
}

export function getChildren(n, skipMe) {
    var r = [];
    for (; n; n = n.nextSibling) {
        if (n.nodeType == 1 && n != skipMe) {
            r.push(n);
        }
    }

    return r;
}

export function getSiblings(n) {
    return getChildren(n.parentNode.firstChild, n);
}

export function getElementIndex(node) {
    var index = 0;
    while ( (node = node.previousElementSibling) ) {
        index++;
    }
    return index;
}


function makeSticky(sticky) {
  var stickyBlockLeft = sticky.getBoundingClientRect().x;
  sticky.style.position = '';
  sticky.style.position = 'fixed';
  sticky.classList.add('sticky-fixed');
  sticky.style.left = (stickyBlockLeft - Number(window.getComputedStyle(sticky).marginLeft.replace(/[^0-9]/g, ''))) + 'px';
  sticky.style.marginTop = '';
}

function makeUnsticky(sticky) {
  sticky.style.position = 'relative';
  sticky.classList.remove('sticky-fixed');
  sticky.style.left = '';
  sticky.style.top = '';
  sticky.style.transform = '';
  sticky.style.height = '';
}

export function makeStickySidebar(stickyBlock, stickyContainer, bottomElem, align = false) {

  var body = document.querySelector('body');

  if (window.getBoundingClientRect().y < 30) {
      makeUnsticky(stickyBlock);
      if (align) stickyContainer.style.alignSelf = '';
      return false;
  }

  var stickyBlockLeft = stickyBlock.getBoundingClientRect().x;

  // var windowTop = window.getBoundingClientRect().y;
  // var stickyParent = stickyBlock.parentElement;
  // var stickyParentTop = body.getAttribute('data-parent_top') || '';
  // if (stickyParentTop == '') {
  //     stickyParentTop = getOffset(stickyParent).top;
  //     body.setAttribute('data-parent_top', stickyParentTop);
  // }

  var stickyTop = getOffset(stickyBlock).top + stickyBlock.offsetHeight;
  var stickyTop = window.getBoundingClientRect().y + stickyBlock.offsetHeight;
  var bottomTop = getOffset(bottomElem).top + bottomElem.offsetHeight;

  var bottomElemCheck = stickyTop > bottomTop;
  var diff = bottomTop - stickyTop;
  var backTop = false;
  if (diff > 50 && windowTop > stickyParentTop) backTop = true;

  var scrollTop = windowTop + stickyBlock.offsetHeight + 30;

  if ($(window).scrollTop() > 30) {
      if (scrollTop > bottomTop) bottomElemCheck = true;
  }

  if (stickyBlock.style.position != 'fixed') {
      if ((stickyBlock.getBoundingClientRect().top < 50 && !bottomElemCheck) || backTop) {
          makeSticky(stickyBlock);
          if (align) stickyContainer.style.alignSelf = '';
      } else {
          if (stickyBlock.getBoundingClientRect().top > 50 && bottomElemCheck) {
              makeSticky(stickyBlock);
              if (align) stickyContainer.style.alignSelf = '';
          }
      }

  } else {
      if (getOffset(stickyBlock).top <= (getOffset(stickyContainer).top + 30)) {
          makeUnsticky(stickyBlock);
          if (align) stickyContainer.style.alignSelf = '';
      } else {
          if (bottomElemCheck) {
              makeUnsticky(stickyBlock);
              stickyBlock.style.marginTop = 'auto';
              if (align) stickyContainer.style.alignSelf = 'end';
          }
      }
  }
}
