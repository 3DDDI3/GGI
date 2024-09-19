import Swiper, {Navigation, Pagination, EffectFade, Autoplay, EffectCoverflow} from "swiper";
import { getElementIndex } from "../js/functions";

const mainSliderDelay = 5000;

var mainSlider = new Swiper('.js-main-screen-slider', {

    modules: [Navigation, Pagination, EffectFade, Autoplay],
    // Optional parameters
    direction: 'vertical',
    loop: false,

    noSwiping: true,
    noSwipingClass: 'swiper-slide',
  
    autoplay: {
      delay: mainSliderDelay,
      disableOnInteraction: true
  //    reverseDirection: true
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
      nextEl: '.js-main-screen-slider__navigation .swiper-button-next',
    },
  
  });

  mainSlider.on('slideChange', e => {
    if (mainSlider.isEnd){
      setTimeout(()=>{
        mainSlider.slideTo(0);
      }, mainSliderDelay);
    }
  });

  var photosSlider = new Swiper('.js-photos-slider', {
      modules: [Navigation],
      direction: 'horizontal',
      loop: true,
      slidesPerView: 3,
      spaceBetween: 20,
    
    
      // If we need pagination
      navigation: {
        prevEl: '.js-photos-slider .swiper-button-prev',
        nextEl: '.js-photos-slider .swiper-button-next',
      },
  });
  
let newsSlider = null;
let portfolioSlider = null;

function swiperMode(slider, sliderSelector) {
    let mobile = window.matchMedia('(min-width: 0px) and (max-width: 980px)');
    let desktop = window.matchMedia('(min-width: 981px)');
    // Enable (for mobile)
    if(mobile.matches) {
        if (!slider) {
            slider = new Swiper(sliderSelector, {
                modules: [Navigation,EffectCoverflow],
                slidesPerView: 1,
                autoplay: {
                    delay: 100,
                    disableOnInteraction: false,
                },
                centeredSlides: true,
                loop: true,
                spaceBetween: 10,
                direction: 'horizontal',
                effect: 'coverflow',

                navigation: {
                    nextEl: sliderSelector+' .swiper-button-next',
                    prevEl: sliderSelector+' .swiper-button-prev',
                },

                coverflowEffect: {
                    rotate: 0,
                    stretch: 0,
                    depth: 0,
                    modifier: 0,
                    slideShadows: false,
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
                            slideShadows: false,
                        }
                    }

                }

            });
        }

    }

    else if(desktop.matches) {
      if (slider){
        slider.destroy();
      }
      
  }

}

window.addEventListener('load', function() {
  swiperMode(newsSlider, '.js-board-news');
  swiperMode(portfolioSlider, '.js-board-portfolio');
});


window.addEventListener('resize', function() {
  swiperMode(newsSlider, '.js-board-news');
  swiperMode(portfolioSlider, '.js-board-portfolio');
});


var galleryThumbsSlider = new Swiper('.js-gallery__thumbs-slider', {
  modules: [EffectCoverflow],
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
      slideShadows: false,
  },


});

var galleryMainSlider = new Swiper('.js-gallery__main-slider', {
  modules: [EffectCoverflow],
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
      slideShadows: false,
  },

});

galleryMainSlider.on("slideChange", () => {
  galleryThumbsSlider.slideTo(galleryMainSlider.activeIndex);
});

galleryThumbsSlider.on("slideChange", () => {
  galleryMainSlider.slideTo(galleryThumbsSlider.activeIndex);
});




if (galleryMainSlider){
    let previousArrow = document.querySelector('.js-gallery__thumbs-slider-arrow-prev');
    let nextArrow = document.querySelector('.js-gallery__thumbs-slider-arrow-next');
    if (previousArrow && nextArrow){
      function checkArrows(){
        
          if (galleryMainSlider.isBeginning){
            previousArrow.setAttribute('disabled', 'disabled');
          }
          else{
            previousArrow.removeAttribute('disabled');
          }
          if (galleryMainSlider.isEnd){
            nextArrow.setAttribute('disabled', 'disabled');
          }
          else{
            nextArrow.removeAttribute('disabled');
          }
        
      }

      window.addEventListener('load', () => {
        checkArrows();
      });

      galleryMainSlider.on('slideChange', () => {
        checkArrows();
      });

      previousArrow.addEventListener('click', ()=>{
        galleryMainSlider.slidePrev();
      });

      nextArrow.addEventListener('click', ()=>{
        galleryMainSlider.slideNext();
      });

      document.querySelectorAll('.js-gallery__thumbs-slider-slide').forEach(thumb => {
        thumb.addEventListener('click', function(){
          let index = getElementIndex(thumb);
          galleryMainSlider.slideTo(index);
        });
      });

    }
    
}


  