"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/auth"],{

/***/ "./resources/js/pa/auth.js":
/*!*********************************!*\
  !*** ./resources/js/pa/auth.js ***!
  \*********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.string.trim.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());



var btnChange1 = document.getElementById("changeForm1");
var btnChange2 = document.getElementById("changeForm2");
var logInForm = document.getElementById("showLogIn");
var signInForm = document.getElementById("showSingIn");
var container = document.querySelector(".auth__container");
btnChange1.addEventListener("click", function (e) {
  e.preventDefault();
  logInForm.classList.remove("active");
  setTimeout(function () {
    signInForm.classList.add("active");
  }, 1000);
});
btnChange2.addEventListener("click", function (e) {
  e.preventDefault();
  signInForm.classList.remove("active");
  setTimeout(function () {
    logInForm.classList.add("active");
  }, 1000);
});
document.querySelectorAll(".auth__input").forEach(function (input) {
  input.addEventListener("input", function () {
    var span = this.nextElementSibling;

    if (this.value.trim()) {
      input.style.color = "#000";
      span.classList.add("visible");
    } else {
      input.style.color = "#fff";
      span.classList.remove("visible");
    }
  });
});

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ var __webpack_exec__ = function(moduleId) { return __webpack_require__(__webpack_require__.s = moduleId); }
/******/ var __webpack_exports__ = (__webpack_exec__("./resources/js/pa/auth.js"));
/******/ }
]);