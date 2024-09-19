// if ($(window).width() <= 896) {
//   $('.preloader_wrap').show();
//   $('body').addClass('preloader_hidden');
//
//   $('#canvas').hide();
//   $('#preloader-text').hide();
//   $('html').addClass('is-loaded');
//
//   $(window).on('load', function () {
//     $('body').removeClass('preloader_hidden');
//     $('.preloader_wrap').fadeOut().end().delay(400).fadeOut('slow');
//   })
//
// } else


if(!/iPhone|iPad|iPod/i.test(navigator.userAgent) && $(window).width() <= 896){
// if(false){
  $('.preloader_wrap').show();
  $('body').addClass('preloader_hidden');

  $('#canvas').hide();
  $('#preloader-text').hide();
  $('html').addClass('is-loaded');

  $(window).on('load', function () {
    $('body').removeClass('preloader_hidden');
    $('.preloader_wrap').fadeOut().end().delay(400).fadeOut('slow');
  })
} else if('initRingParticles' in window) {

  window.initRingParticles();


  const html = $('html');

  const canvas = $('#canvas');
  const preloaderText = $('#preloader-text');
  const preloaderTextEnter = $('#preloader-text-enter');

  // if (sessionStorage.getItem('firstVisit') != null) {
  //   preloaderTextEnter.hide();
  // }

  // preloaderTextEnter.on('click', (event) => {
  //   event.preventDefault();
  //
  //   preloaderText.animate({
  //     opacity: 0,
  //   }, 500);
  //
  //   canvas.animate({
  //     opacity: 0,
  //   }, 1000, () => {
  //     canvas.remove();
  //     html.addClass('is-loaded');
  //   })
  // });

  window.onload = function() {
    $('.bim_video').show();
      setTimeout(function () {
        preloaderText.animate({
          // opacity: 0,
        }, 500);

        /*canvas.animate({
          opacity: 0,
        }, 1000, () => {
          canvas.remove();
          html.addClass('is-loaded');
        });*/
      }, 2500);
  }

  // $(window).on('load', function () {
    // if (sessionStorage.getItem('firstVisit') != null) {
    //
    //   preloaderTextEnter.trigger('click');
    //
    // } else  {
    //   sessionStorage.setItem('firstVisit', 1);
    // }
  // })
}

// $(document).ready(function () {
//   $(window).resize(function() {
//
//     if (!$('html').hasClass('is-loaded')) {
//       let canvas = $('#canvas'),
//           width = canvas.innerWidth(),
//           height = canvas.innerHeight();
//
//       if ($(window).height() < $(window).width()) {
//
//         canvas.addClass('rorate');
//         // canvas.css({
//         //   top: '50%',
//         //   left: '50%',
//         //   marginTop: -width / 2,
//         //   marginLeft: -height / 2,
//         // });
//
//       } else {
//         canvas.removeClass('rorate');
//         // canvas.css({
//         //   top: '0',
//         //   left: '0',
//         //   marginTop: 0,
//         //   marginLeft: 0,
//         // })
//       }
//     }
//   });
// });

