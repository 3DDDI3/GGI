"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["/js/script"],{

/***/ "./resources/js/pa/script.js":
/*!***********************************!*\
  !*** ./resources/js/pa/script.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.object.to-string.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/web.dom-collections.for-each.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.array.map.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.array.from.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.string.iterator.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.function.name.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.array.includes.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
Object(function webpackMissingModule() { var e = new Error("Cannot find module 'core-js/modules/es.string.includes.js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());








var dt = new DataTransfer(); // toggle/switch

var option1 = document.getElementById("option1");
var option2 = document.getElementById("option2");
var sectionAbit = document.getElementById("abit");
var sectionDiploma = document.getElementById("diplomSec");
var sectionScientist = document.getElementById("scientist");
var sectionAdditional = document.getElementById("additional");
var navList = document.getElementById("examLink");
var appForm = document.getElementById("appForm"); // абитуриент

var pgForm = document.getElementById("pgForm"); // аспирант

function curSelect() {
  if (option1.checked) {
    // console.log("Current select: Абитуриент");
    sectionAbit.classList.toggle("hidden");
    sectionDiploma.classList.toggle("hidden");
    sectionScientist.classList.toggle("hidden");
    sectionAdditional.classList.toggle("hidden");
    navList.classList.toggle("hidden");
    appForm.classList.remove("hidden");
    pgForm.classList.add("hidden");
  } else if (option2.checked) {
    // console.log("Current select: Аспирант");
    sectionAbit.classList.toggle("hidden");
    sectionDiploma.classList.toggle("hidden");
    sectionScientist.classList.toggle("hidden");
    sectionAdditional.classList.toggle("hidden");
    navList.classList.toggle("hidden");
    appForm.classList.add("hidden");
    pgForm.classList.remove("hidden");
  }
}

option1.addEventListener("change", curSelect);
option2.addEventListener("change", curSelect);
var select = document.getElementById("date-select");

for (var year = 2024; year >= 1910; year--) {
  var option = document.createElement("option");
  option.value = year;
  option.text = year;
  select.appendChild(option);
}

var choices = new Choices(select, {
  searchEnabled: false,
  itemSelectText: "",
  sorter: function sorter(a, b) {
    return b.label.length - a.label.length;
  }
});

for (var _year = 1920; _year <= 2025; _year++) {
  var _option = document.createElement("option");

  _option.value = _year;
  _option.innerHTML = _year;
  document.getElementById("date-select").appendChild(_option);
} // end toggle
// files


var max_files = 10;
document.querySelectorAll(".input-file input[type=file]").forEach(function (input) {
  input.addEventListener("change", function () {
    var _this = this;

    var filesList = this.closest(".input-file").nextElementSibling;
    var existingFiles = Array.from(dt.items).map(function (item) {
      return item.getAsFile().name;
    });

    if (dt.items.length >= max_files) {
      alert("Вы не можете загрузить больше 10 файлов");
      this.valie = "";
      return;
    }

    Array.from(this.files).forEach(function (file) {
      if (!existingFiles.includes(file.name)) {
        var fileItem = document.createElement("li");
        fileItem.classList.add("input-file-list-item");
        var fileName = document.createElement("span");
        fileName.classList.add("input-file-list-name");
        fileName.textContent = file.name;

        var btn = _this.parentNode.querySelector("span");

        btn.classList.add("btn-more");
        btn.textContent = "+ Добавить ещё"; // let list = document.querySelector(".input-file-list");

        var list = _this.parentNode.nextElementSibling;
        console.log(_this.parentNode.nextElementSibling, "this.parenNode.nextElementSibling");
        console.log(_this.parentNode, "this.parenNode");
        var removeLink = document.createElement("a");
        removeLink.href = "#";
        removeLink.textContent = "x";
        removeLink.classList.add("input-file-list-remove");
        removeLink.addEventListener("click", function (e) {
          e.preventDefault();
          removeFilesItem(file.name, _this);

          if (list.querySelectorAll(".input-file-list-item").length === 0) {
            btn.classList.remove("btn-more");
            btn.textContent = "Выбрать файл";
          }
        });
        var fileSvg = document.createElement("div");
        fileSvg.classList.add("input-file-svg");
        fileItem.appendChild(fileSvg);
        fileItem.appendChild(fileName);
        fileItem.appendChild(removeLink);
        filesList.appendChild(fileItem);
        dt.items.add(file);
      }
    });
    this.files = dt.files;
  });
});

function removeFilesItem(name, input) {
  var filesList = input.closest(".input-file").nextElementSibling;
  var fileItems = filesList.querySelectorAll(".input-file-list-item");
  fileItems.forEach(function (item) {
    var fileItemName = item.querySelector(".input-file-list-name").textContent;

    if (fileItemName === name) {
      filesList.removeChild(item);
    }
  });
  var newFiles = [];
  Array.from(dt.items).forEach(function (item) {
    if (item.getAsFile().name !== name) {
      newFiles.push(item.getAsFile());
    }
  });
  dt.items.clear();
  newFiles.forEach(function (file) {
    return dt.items.add(file);
  });
  input.files = dt.files;
} // загрузчик аватарки


document.getElementById("file-input").addEventListener("change", function (event) {
  var file = event.target.files[0];

  if (file) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var imagePreview = document.getElementById("image-preview");
      imagePreview.src = e.target.result;
      imagePreview.style.display = "block";
    };

    reader.readAsDataURL(file);
  }
}); // sidebar

document.addEventListener("DOMContentLoaded", function () {
  var navLinks = document.querySelectorAll(".nav__link");
  var forms = document.querySelectorAll(".main-container");
  navLinks.forEach(function (link) {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      var navItems = this.parentNode;
      navLinks.forEach(function (navLink) {
        return navLink.parentNode.classList.remove("active");
      });
      this.parentNode.classList.add("active");
      var target = this.getAttribute("data-target");
      forms.forEach(function (form) {
        return form.classList.remove("active");
      });
      var activeForm = document.querySelector(".main-container.".concat(target));

      if (activeForm) {
        activeForm.classList.add("active");
      }
    });
  });
}); // exit

document.addEventListener("DOMContentLoaded", function () {
  var btnLogOut = document.getElementById("logOut");
  var popup = document.getElementById("popup");
  var yesBtn = document.getElementById("yesBtn");
  var noBtn = document.getElementById("noBtn");
  btnLogOut.addEventListener("click", function () {
    setTimeout(function () {
      popup.classList.add("visible");
    }, 10);
  });
  yesBtn.addEventListener("click", function () {
    alert("Вы вышли из аккаунта");
    popup.classList.remove("visible");
  });
  noBtn.addEventListener("click", function () {
    alert("Вы не вышли из аккаунта");
    popup.classList.remove("visible");
  });
});

/***/ })

},
/******/ function(__webpack_require__) { // webpackRuntimeModules
/******/ var __webpack_exec__ = function(moduleId) { return __webpack_require__(__webpack_require__.s = moduleId); }
/******/ var __webpack_exports__ = (__webpack_exec__("./resources/js/pa/script.js"));
/******/ }
]);