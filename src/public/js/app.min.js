"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/app"],{

/***/ "./resources/js/Accordion.js":
/*!***********************************!*\
  !*** ./resources/js/Accordion.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
/* harmony import */ var _js_functions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../js/functions */ "./resources/js/functions.js");




(function () {
  var accordions = document.querySelectorAll('.js-accordion');
  var activeClass = 'accordion__item_active';
  accordions.forEach(function (accordion) {
    var items = accordion.querySelectorAll('.js-accordion__item');
    items.forEach(function (item) {
      var button = item.querySelector('.js-accordion__head');
      var body = item.querySelector('.js-accordion__body');
      button.addEventListener('click', function (e) {
        if (item.classList.contains(activeClass)) {
          (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.slideUp)(body);
          item.classList.remove(activeClass);
        } else {
          var siblings = (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.getSiblings)(button.closest('.js-accordion__item'));

          if (siblings.length > 0) {
            siblings.forEach(function (sibling) {
              (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.slideUp)(sibling.querySelector('.js-accordion__body'));
              sibling.classList.remove(activeClass);
            });
          }

          (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.slideDown)(body);
          item.classList.add(activeClass);
        }
      });
    });
  });
})();

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _navigation__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./navigation */ "./resources/js/navigation.js");
/* harmony import */ var _sliders_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./sliders.js */ "./resources/js/sliders.js");
/* harmony import */ var _Accordion_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Accordion.js */ "./resources/js/Accordion.js");
/* harmony import */ var _tabs_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./tabs.js */ "./resources/js/tabs.js");
/* harmony import */ var _validator__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./validator */ "./resources/js/validator.js");
/* harmony import */ var _institute_objects_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./institute-objects.js */ "./resources/js/institute-objects.js");
/* harmony import */ var _search_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./search.js */ "./resources/js/search.js");
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding react to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */








(function () {
  var forgotPasswordButton = document.querySelector('.js-auth__forgot-password-button');
  var primaryButton = document.querySelector('.js-auth__primary-button');
  var forgotPasswordBox = document.querySelector('.js-auth__forgot-password-box');
  var primaryBox = document.querySelector('.js-auth__primary');

  if (!!forgotPasswordButton) {
    forgotPasswordButton.addEventListener('click', function () {
      forgotPasswordBox.classList.add('auth__forgot-password-box_active');
      primaryBox.classList.remove('auth__primary_active');
    });
    primaryButton.addEventListener('click', function () {
      primaryBox.classList.add('auth__primary_active');
      forgotPasswordBox.classList.remove('auth__forgot-password-box_active');
    });
  }

  (0,_validator__WEBPACK_IMPORTED_MODULE_4__["default"])();
})();

window.addEventListener('scroll', function () {
  if (window.innerWidth > 980) {}
});

/***/ }),

/***/ "./resources/js/functions.js":
/*!***********************************!*\
  !*** ./resources/js/functions.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   fadeIn: function() { return /* binding */ fadeIn; },
/* harmony export */   fadeOut: function() { return /* binding */ fadeOut; },
/* harmony export */   getChildren: function() { return /* binding */ getChildren; },
/* harmony export */   getElementIndex: function() { return /* binding */ getElementIndex; },
/* harmony export */   getOffset: function() { return /* binding */ getOffset; },
/* harmony export */   getSiblings: function() { return /* binding */ getSiblings; },
/* harmony export */   isHidden: function() { return /* binding */ isHidden; },
/* harmony export */   makeAnimation: function() { return /* binding */ makeAnimation; },
/* harmony export */   makeStickySidebar: function() { return /* binding */ makeStickySidebar; },
/* harmony export */   onClickOutside: function() { return /* binding */ onClickOutside; },
/* harmony export */   scrollWidth: function() { return /* binding */ scrollWidth; },
/* harmony export */   slideDown: function() { return /* binding */ slideDown; },
/* harmony export */   slideToggle: function() { return /* binding */ slideToggle; },
/* harmony export */   slideUp: function() { return /* binding */ slideUp; }
/* harmony export */ });
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.number.constructor.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.regexp.exec.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.string.replace.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());



function getOffset(el) {
  el = el.getBoundingClientRect();
  return {
    left: el.left + window.scrollX,
    top: el.top + window.scrollY
  };
}
var div = document.createElement('div');
div.style.overflowY = 'scroll';
div.style.width = '50px';
div.style.height = '50px';
document.body.append(div);
var scrollWidth = div.offsetWidth - div.clientWidth;
div.remove();
function makeAnimation(el, name) {
  function enter() {
    el.style.display = "block";
    el.classList.add("".concat(name, "-enter-from"));
    el.classList.add("".concat(name, "-enter-active"));
    el.classList.add("".concat(name, "-enter-to"));
    el.classList.remove("".concat(name, "-enter-from"));

    var onEnd = function onEnd(e) {
      if (e.target === el) {
        el.classList.remove("".concat(name, "-enter-active"));
        el.classList.remove("".concat(name, "-enter-to"));
        el.removeEventListener("animationend", onEnd);
      }
    };

    el.addEventListener("animationend", onEnd);
  }

  function leave() {
    el.classList.add("".concat(name, "-leave-from"));
    el.classList.add("".concat(name, "-leave-active"));

    (function () {
      el.classList.add("".concat(name, "-leave-to"));
      el.classList.remove("".concat(name, "-leave-from"));

      var onEnd = function onEnd(e) {
        if (e.target === el) {
          el.classList.remove("".concat(name, "-leave-active"));
          el.classList.remove("".concat(name, "-leave-to"));
          el.removeEventListener("animationend", onEnd);
          el.style.display = "none";
        }
      };

      el.addEventListener("animationend", onEnd);
    })();
  }

  return {
    enter: enter,
    leave: leave
  };
}
function fadeOut(el) {
  el.style.opacity = 1;

  (function fade() {
    if ((el.style.opacity -= .1) < 0) {
      el.style.display = "none";
    } else {
      requestAnimationFrame(fade);
    }
  })();
}
;
function fadeIn(el, display) {
  el.style.opacity = 0;
  el.style.display = display || "block";

  (function fade() {
    var val = parseFloat(el.style.opacity);

    if (!((val += .1) > 1)) {
      el.style.opacity = val;
      requestAnimationFrame(fade);
    }
  })();
}
;
function slideUp(target) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
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
  window.setTimeout(function () {
    target.style.display = 'none';
    target.style.removeProperty('height');
    target.style.removeProperty('padding-top');
    target.style.removeProperty('padding-bottom');
    target.style.removeProperty('margin-top');
    target.style.removeProperty('margin-bottom');
    target.style.removeProperty('overflow');
    target.style.removeProperty('transition-duration');
    target.style.removeProperty('transition-property'); //alert("!");
  }, duration);
}
function slideDown(target) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
  target.style.removeProperty('display');
  var display = window.getComputedStyle(target).display;
  if (display === 'none') display = 'block';
  target.style.display = display;
  var height = target.offsetHeight;
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
  window.setTimeout(function () {
    target.style.removeProperty('height');
    target.style.removeProperty('overflow');
    target.style.removeProperty('transition-duration');
    target.style.removeProperty('transition-property');
  }, duration);
}
function slideToggle(target) {
  var duration = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;

  if (window.getComputedStyle(target).display === 'none') {
    return slideDown(target, duration);
  } else {
    return slideUp(target, duration);
  }
}
function onClickOutside(ele, cb) {
  document.addEventListener('click', function (event) {
    if (!ele.contains(event.target)) cb();
  });
}
function isHidden(el) {
  return el.offsetParent === null;
}
function getChildren(n, skipMe) {
  var r = [];

  for (; n; n = n.nextSibling) {
    if (n.nodeType == 1 && n != skipMe) {
      r.push(n);
    }
  }

  return r;
}
function getSiblings(n) {
  return getChildren(n.parentNode.firstChild, n);
}
function getElementIndex(node) {
  var index = 0;

  while (node = node.previousElementSibling) {
    index++;
  }

  return index;
}

function makeSticky(sticky) {
  var stickyBlockLeft = sticky.getBoundingClientRect().x;
  sticky.style.position = '';
  sticky.style.position = 'fixed';
  sticky.classList.add('sticky-fixed');
  sticky.style.left = stickyBlockLeft - Number(window.getComputedStyle(sticky).marginLeft.replace(/[^0-9]/g, '')) + 'px';
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

function makeStickySidebar(stickyBlock, stickyContainer, bottomElem) {
  var align = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : false;
  var body = document.querySelector('body');

  if (window.getBoundingClientRect().y < 30) {
    makeUnsticky(stickyBlock);
    if (align) stickyContainer.style.alignSelf = '';
    return false;
  }

  var stickyBlockLeft = stickyBlock.getBoundingClientRect().x; // var windowTop = window.getBoundingClientRect().y;
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
    if (stickyBlock.getBoundingClientRect().top < 50 && !bottomElemCheck || backTop) {
      makeSticky(stickyBlock);
      if (align) stickyContainer.style.alignSelf = '';
    } else {
      if (stickyBlock.getBoundingClientRect().top > 50 && bottomElemCheck) {
        makeSticky(stickyBlock);
        if (align) stickyContainer.style.alignSelf = '';
      }
    }
  } else {
    if (getOffset(stickyBlock).top <= getOffset(stickyContainer).top + 30) {
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

/***/ }),

/***/ "./resources/js/institute-objects.js":
/*!*******************************************!*\
  !*** ./resources/js/institute-objects.js ***!
  \*******************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());


var CSRF = document.querySelector('input[name=_token]').value;
var objects_map = document.getElementById("objects-map");

if (typeof objects_map != 'undefined' && objects_map != null) {
  var request = new XMLHttpRequest();
  var url = "/ajax/get-institute-object";
  var params = '';
  request.open("POST", url, true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.setRequestHeader("X-CSRF-TOKEN", CSRF);
  request.addEventListener("readystatechange", function () {
    if (request.readyState === 4 && request.status === 200) {
      var data = JSON.parse(request.responseText),
          map_params = [];
      data.forEach(function (object, index) {
        var object_data = {
          "type": "Feature",
          "id": index,
          "geometry": {
            "type": "Point",
            "coordinates": [object.coordinates_x, object.coordinates_y]
          },
          "properties": {
            "balloonText": object.text,
            "balloonLink": "#"
          },
          "options": {
            "preset": "mark#icon",
            "hideIconOnBalloonOpen": false
          }
        };
        map_params.push(object_data);
      });
      initMap('objects-map', map_params);
    }
  });
  request.send(params);
}

/***/ }),

/***/ "./resources/js/navigation.js":
/*!************************************!*\
  !*** ./resources/js/navigation.js ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
/* harmony import */ var _js_functions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../js/functions */ "./resources/js/functions.js");




(function () {
  var html = document.querySelector('html');
  var body = document.querySelector('body');
  var header = document.querySelector('header');
  var menu = document.querySelector('.header__mobile-menu');
  var burger = document.querySelector('.header__burger');
  var isExpanded = false;

  function menuChange() {
    if (isExpanded) {
      burger.classList.add('active');
      menu.style.display = 'flex';
      menu.style.opacity = 1;
      body.style.overflow = 'hidden';
      html.style.overflow = 'hidden';
      header.classList.add('header_white_links');
    } else {
      burger.classList.remove('active');
      menu.style.opacity = '';
      menu.style.display = '';
      body.style.overflow = '';
      html.style.overflow = '';
      header.style.color = '';
      header.classList.remove('header_white_links');
    }
  }

  burger.addEventListener('click', function () {
    isExpanded = !isExpanded;
    menuChange();
  });
  document.addEventListener('click', function (e) {
    if (e.target.closest('.header__menu-item')) {
      isExpanded = false;
      menuChange();
    }
  });
  document.querySelectorAll('.js-navigation__item.navigation__item_with_group').forEach(function (elem) {
    var group = elem.querySelector('.js-navigation-group');
    var link = elem.querySelector('.js-navigation__link');
    var activeClass = 'navigation__item_with_group_active';
    elem.addEventListener('mouseenter', function (e) {
      if (window.innerWidth > 1360) {
        (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.fadeIn)(group);
        elem.classList.add(activeClass);
      }
    });
    elem.addEventListener('mouseleave', function (e) {
      if (window.innerWidth > 1360) {
        (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.fadeOut)(group);
        elem.classList.remove(activeClass);
      }
    });
    link.addEventListener('click', function () {
      (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.slideToggle)(group);
      elem.classList.toggle(activeClass);
    });
  });
  document.addEventListener('mousemove', function (e) {
    if (!e.target.closest('.navigation__item_with_group') && window.innerWidth > 1360) {
      document.querySelectorAll('.js-navigation__item.navigation__item_with_group').forEach(function (elem) {
        var group = elem.querySelector('.js-navigation-group');
        if (group.style.display == 'block') (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.fadeOut)(group);
        elem.classList.remove('navigation__item_with_group_active');
      });
    }
  });
})();

/***/ }),

/***/ "./resources/js/search.js":
/*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _functions_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./functions.js */ "./resources/js/functions.js");

var CSRF = document.querySelector('input[name=_token]').value;
var searchForm = document.querySelector('.search__form');
var searchInput = document.querySelector('.search__input');
var searchResults = document.querySelector('.search-results__container');
var search_from_container = document.querySelector('.search-form-container');
var search_form_active_btn = document.querySelector('.search-form-active-btn');
var search_from_close_btn = document.querySelector('.search-from-close-btn');
var searchButton = document.querySelector('.search__button');

if (typeof searchForm != 'undefined' && searchForm != null && typeof searchInput != 'undefined' && searchInput != null && typeof searchResults != 'undefined' && searchResults != null) {
  var search = function search(query) {
    var request = new XMLHttpRequest();
    var url = "/ajax/search"; // const params = JSON.stringify({
    //     query:  query
    // });

    var params = 'query=' + query;
    request.open("POST", url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.setRequestHeader("X-CSRF-TOKEN", CSRF);
    request.addEventListener("readystatechange", function () {
      if (request.readyState === 4 && request.status === 200) {
        // let data = JSON.parse(request.responseText);
        searchResults.innerHTML = request.responseText;
      }
    });
    request.send(params);
  };

  var searchEvent = function searchEvent(e) {
    var query = searchInput.value;

    if (searchInput !== document.activeElement) {
      searchInput.focus();
    }

    try {
      search(query);
    } catch (e) {
      console.log(e);
      return true;
    } finally {
      e.preventDefault();
      e.stopPropagation();
    }
  };

  if (typeof searchButton != 'undefined' && search_from_container != null) {
    searchButton.addEventListener('mousedown', function (e) {
      e.preventDefault();
    });
    searchButton.addEventListener('click', searchEvent);
  } // searchForm.submit(searchEvent);


  if (searchInput.value !== '') {
    searchEvent();
  }
}

if (typeof search_from_container != 'undefined' && search_from_container != null) {
  function close_search_form() {
    (0,_functions_js__WEBPACK_IMPORTED_MODULE_0__.fadeOut)(search_from_container);
  }

  search_form_active_btn.addEventListener('click', function () {
    var search_input = search_from_container.querySelector("[name='query']");

    if ((0,_functions_js__WEBPACK_IMPORTED_MODULE_0__.isHidden)(search_from_container)) {
      (0,_functions_js__WEBPACK_IMPORTED_MODULE_0__.fadeIn)(search_from_container);
    }

    search_input.focus();
  });
  search_from_close_btn.addEventListener('click', function () {
    close_search_form();
  });
  (0,_functions_js__WEBPACK_IMPORTED_MODULE_0__.onClickOutside)(search_from_container, function () {
    return close_search_form();
  });
}

/***/ }),

/***/ "./resources/js/sliders.js":
/*!*********************************!*\
  !*** ./resources/js/sliders.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
/* harmony import */ var swiper__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! swiper */ "./node_modules/swiper/swiper.esm.js");
/* harmony import */ var _js_functions__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../js/functions */ "./resources/js/functions.js");




var mainSliderDelay = 5000;
var mainSlider = new swiper__WEBPACK_IMPORTED_MODULE_1__["default"]('.js-main-screen-slider', {
  modules: [swiper__WEBPACK_IMPORTED_MODULE_1__.Navigation, swiper__WEBPACK_IMPORTED_MODULE_1__.Pagination, swiper__WEBPACK_IMPORTED_MODULE_1__.EffectFade, swiper__WEBPACK_IMPORTED_MODULE_1__.Autoplay],
  // Optional parameters
  direction: 'vertical',
  loop: false,
  noSwiping: true,
  noSwipingClass: 'swiper-slide',
  autoplay: {
    delay: mainSliderDelay,
    disableOnInteraction: true //    reverseDirection: true

  },
  effect: 'fade',
  fadeEffect: {
    crossFade: true
  },
  // If we need pagination
  pagination: {
    el: '.js-main-screen-slider .swiper-pagination',
    clickable: 'true'
  },
  navigation: {
    prevEl: '.js-main-screen-slider__navigation .swiper-button-prev',
    nextEl: '.js-main-screen-slider__navigation .swiper-button-next'
  }
});
mainSlider.on('slideChange', function (e) {
  if (mainSlider.isEnd) {
    setTimeout(function () {
      mainSlider.slideTo(0);
    }, mainSliderDelay);
  }
});
var photosSlider = new swiper__WEBPACK_IMPORTED_MODULE_1__["default"]('.js-photos-slider', {
  modules: [swiper__WEBPACK_IMPORTED_MODULE_1__.Navigation],
  direction: 'horizontal',
  loop: true,
  slidesPerView: 3,
  spaceBetween: 20,
  // If we need pagination
  navigation: {
    prevEl: '.js-photos-slider .swiper-button-prev',
    nextEl: '.js-photos-slider .swiper-button-next'
  }
});
var newsSlider = null;
var portfolioSlider = null;

function swiperMode(slider, sliderSelector) {
  var mobile = window.matchMedia('(min-width: 0px) and (max-width: 980px)');
  var desktop = window.matchMedia('(min-width: 981px)'); // Enable (for mobile)

  if (mobile.matches) {
    if (!slider) {
      slider = new swiper__WEBPACK_IMPORTED_MODULE_1__["default"](sliderSelector, {
        modules: [swiper__WEBPACK_IMPORTED_MODULE_1__.Navigation, swiper__WEBPACK_IMPORTED_MODULE_1__.EffectCoverflow],
        slidesPerView: 1,
        autoplay: {
          delay: 100,
          disableOnInteraction: false
        },
        centeredSlides: true,
        loop: true,
        spaceBetween: 10,
        direction: 'horizontal',
        effect: 'coverflow',
        navigation: {
          nextEl: sliderSelector + ' .swiper-button-next',
          prevEl: sliderSelector + ' .swiper-button-prev'
        },
        coverflowEffect: {
          rotate: 0,
          stretch: 0,
          depth: 0,
          modifier: 0,
          slideShadows: false
        },
        breakpoints: {
          980: {
            slidesPerView: 1,
            spaceBetween: 0,
            effect: 'coverflow',
            coverflowEffect: {
              rotate: 0,
              stretch: 20,
              depth: 120,
              modifier: 3,
              slideShadows: false
            }
          }
        }
      });
    }
  } else if (desktop.matches) {
    if (slider) {
      slider.destroy();
    }
  }
}

window.addEventListener('load', function () {
  swiperMode(newsSlider, '.js-board-news');
  swiperMode(portfolioSlider, '.js-board-portfolio');
});
window.addEventListener('resize', function () {
  swiperMode(newsSlider, '.js-board-news');
  swiperMode(portfolioSlider, '.js-board-portfolio');
});
var galleryThumbsSlider = new swiper__WEBPACK_IMPORTED_MODULE_1__["default"]('.js-gallery__thumbs-slider', {
  modules: [swiper__WEBPACK_IMPORTED_MODULE_1__.EffectCoverflow],
  slidesPerView: 3,
  //centeredSlides: true,
  //loop: true,
  freeMode: true,
  watchSlidesVisibility: true,
  watchSlidesProgress: true,
  spaceBetween: 16,
  direction: 'horizontal',
  effect: 'coverflow',
  slideToClickedSlide: true,
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 0,
    modifier: 0,
    slideShadows: false
  }
});
var galleryMainSlider = new swiper__WEBPACK_IMPORTED_MODULE_1__["default"]('.js-gallery__main-slider', {
  modules: [swiper__WEBPACK_IMPORTED_MODULE_1__.EffectCoverflow],
  slidesPerView: 1,
  centeredSlides: true,
  //loop: true,
  direction: 'horizontal',
  effect: 'coverflow',
  thumbs: {
    swiper: galleryThumbsSlider
  },
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 0,
    modifier: 0,
    slideShadows: false
  }
});
galleryMainSlider.on("slideChange", function () {
  galleryThumbsSlider.slideTo(galleryMainSlider.activeIndex);
});
galleryThumbsSlider.on("slideChange", function () {
  galleryMainSlider.slideTo(galleryThumbsSlider.activeIndex);
});

if (galleryMainSlider) {
  var previousArrow = document.querySelector('.js-gallery__thumbs-slider-arrow-prev');
  var nextArrow = document.querySelector('.js-gallery__thumbs-slider-arrow-next');

  if (previousArrow && nextArrow) {
    function checkArrows() {
      if (galleryMainSlider.isBeginning) {
        previousArrow.setAttribute('disabled', 'disabled');
      } else {
        previousArrow.removeAttribute('disabled');
      }

      if (galleryMainSlider.isEnd) {
        nextArrow.setAttribute('disabled', 'disabled');
      } else {
        nextArrow.removeAttribute('disabled');
      }
    }

    window.addEventListener('load', function () {
      checkArrows();
    });
    galleryMainSlider.on('slideChange', function () {
      checkArrows();
    });
    previousArrow.addEventListener('click', function () {
      galleryMainSlider.slidePrev();
    });
    nextArrow.addEventListener('click', function () {
      galleryMainSlider.slideNext();
    });
    document.querySelectorAll('.js-gallery__thumbs-slider-slide').forEach(function (thumb) {
      thumb.addEventListener('click', function () {
        var index = (0,_js_functions__WEBPACK_IMPORTED_MODULE_2__.getElementIndex)(thumb);
        galleryMainSlider.slideTo(index);
      });
    });
  }
}

/***/ }),

/***/ "./resources/js/tabs.js":
/*!******************************!*\
  !*** ./resources/js/tabs.js ***!
  \******************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
/* harmony import */ var _js_functions__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../js/functions */ "./resources/js/functions.js");




(function () {
  var tabsWrappers = document.querySelectorAll('.js-tabs-wrapper');

  if (tabsWrappers.length > 0) {
    tabsWrappers.forEach(function (tabsWrapper) {
      tabsWrapper.querySelectorAll('.js-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
          var dataBox = tab.getAttribute('data-box');
          var box = tabsWrapper.querySelector('.js-tab-box[data-tab="' + dataBox + '"]');
          (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.getSiblings)(tab).forEach(function (el) {
            return el.classList.remove('tab-active');
          });
          (0,_js_functions__WEBPACK_IMPORTED_MODULE_1__.getSiblings)(box).forEach(function (el) {
            return el.classList.remove('tab-box-active');
          });
          tab.classList.add('tab-active');
          box.classList.add('tab-box-active');
        });
      });
    });
  }
})();

/***/ }),

/***/ "./resources/js/validator.js":
/*!***********************************!*\
  !*** ./resources/js/validator.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   emailMaskInit: function() { return /* binding */ emailMaskInit; },
/* harmony export */   phoneMaskInit: function() { return /* binding */ phoneMaskInit; }
/* harmony export */ });
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.regexp.exec.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.regexp.test.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
/* harmony import */ var imask__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! imask */ "./node_modules/imask/esm/index.js");





var phoneMaskInit = function phoneMaskInit() {
  var phoneMask = {
    mask: "+{7}(000)000-00-00",
    lazy: false
  };
  var phoneInputs = document.querySelectorAll("input[type=\"tel\"]");
  phoneInputs.forEach(function (input) {
    return new imask__WEBPACK_IMPORTED_MODULE_1__["default"](input, phoneMask);
  });
};
var emailMaskInit = function emailMaskInit() {
  var emailMask = {
    mask: function mask(value) {
      if (/^[a-z0-9_\.-]+$/.test(value)) return true;
      if (/^[a-z0-9_\.-]+@$/.test(value)) return true;
      if (/^[a-z0-9_\.-]+@[a-z0-9-]+$/.test(value)) return true;
      if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.$/.test(value)) return true;
      if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}$/.test(value)) return true;
      if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.$/.test(value)) return true;
      if (/^[a-z0-9_\.-]+@[a-z0-9-]+\.[a-z]{1,4}\.[a-z]{1,4}$/.test(value)) return true;
      return false;
    },
    lazy: false
  };
  var emailInputs = document.querySelectorAll("input[type=\"email\"]");
  emailInputs.forEach(function (input) {
    return new imask__WEBPACK_IMPORTED_MODULE_1__["default"](input, emailMask);
  });
};

var validatorInit = function validatorInit() {
  phoneMaskInit();
  emailMaskInit();
  var validateBeforeSubmit = document.querySelectorAll("form.validate-this");
  console.log(validateBeforeSubmit);
  validateBeforeSubmit.forEach(function (form) {
    form.onsubmit = function (e) {
      e.preventDefault(); // ????

      form.submit();
    };
  });
};

/* harmony default export */ __webpack_exports__["default"] = (validatorInit);

/***/ }),

/***/ "./resources/css/pa/normalize.css":
/*!****************************************!*\
  !*** ./resources/css/pa/normalize.css ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/pa/style.css":
/*!************************************!*\
  !*** ./resources/css/pa/style.css ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/pa/switch.css":
/*!*************************************!*\
  !*** ./resources/css/pa/switch.css ***!
  \*************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/scss/app.scss":
/*!*********************************!*\
  !*** ./resources/scss/app.scss ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/pa/auth.css":
/*!***********************************!*\
  !*** ./resources/css/pa/auth.css ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/pa/input.css":
/*!************************************!*\
  !*** ./resources/css/pa/input.css ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/pa/lib-style.css":
/*!****************************************!*\
  !*** ./resources/css/pa/lib-style.css ***!
  \****************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/pa/media.css":
/*!************************************!*\
  !*** ./resources/css/pa/media.css ***!
  \************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ var __webpack_exec__ = function(moduleId) { return __webpack_require__(__webpack_require__.s = moduleId); }
/******/ __webpack_require__.O(0, ["css/media","css/lib-style","css/input","css/auth","css/app","css/switch","css/style","css/normalize","/js/vendor"], function() { return __webpack_exec__("./resources/js/app.js"), __webpack_exec__("./resources/scss/app.scss"), __webpack_exec__("./resources/css/pa/auth.css"), __webpack_exec__("./resources/css/pa/input.css"), __webpack_exec__("./resources/css/pa/lib-style.css"), __webpack_exec__("./resources/css/pa/media.css"), __webpack_exec__("./resources/css/pa/normalize.css"), __webpack_exec__("./resources/css/pa/style.css"), __webpack_exec__("./resources/css/pa/switch.css"); });
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);