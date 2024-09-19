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




import './navigation';
import './sliders.js';
import './Accordion.js';
import './tabs.js';
import validatorInit from './validator';
import './institute-objects.js';
import './search.js';

(function(){
   let forgotPasswordButton = document.querySelector('.js-auth__forgot-password-button');
   let primaryButton = document.querySelector('.js-auth__primary-button');
   let forgotPasswordBox = document.querySelector('.js-auth__forgot-password-box');
   let primaryBox = document.querySelector('.js-auth__primary');

   if (!!forgotPasswordButton){
      forgotPasswordButton.addEventListener('click', () => {
         forgotPasswordBox.classList.add('auth__forgot-password-box_active');
         primaryBox.classList.remove('auth__primary_active');
     });

     primaryButton.addEventListener('click', () => {
        primaryBox.classList.add('auth__primary_active');
        forgotPasswordBox.classList.remove('auth__forgot-password-box_active');
     });
   }
   validatorInit();


})();

window.addEventListener('scroll', function () {
      if (window.innerWidth > 980 ){

      }
});








