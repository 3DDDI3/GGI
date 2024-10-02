var dt = new DataTransfer();

// toggle/switch
const option1 = document.getElementById("option1");
const option2 = document.getElementById("option2");
const sectionAbit = document.getElementById("abit");
const sectionDiploma = document.getElementById("diplomSec");
const sectionScientist = document.getElementById("scientist");
const sectionAdditional = document.getElementById("additional");
const navList = document.getElementById("examLink");
const appForm = document.getElementById("appForm"); // абитуриент
const pgForm = document.getElementById("pgForm"); // аспирант

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
// option1.addEventListener("change", curSelect);
// option2.addEventListener("change", curSelect);

const select = document.getElementById("date-select");
for (let year = 2024; year >= 1910; year--) {
  const option = document.createElement("option");
  option.value = year;
  option.text = year;
  select.appendChild(option);
}

const choices = new Choices(select, {
  searchEnabled: false,
  itemSelectText: "",
  sorter: function (a, b) {
    return b.label.length - a.label.length;
  },
});

for (let year = 1920; year <= 2025; year++) {
  let option = document.createElement("option");
  option.value = year;
  option.innerHTML = year;
  document.getElementById("date-select").appendChild(option);
}

// end toggle

// files
const max_files = 10;
document.querySelectorAll(".input-file input[type=file]").forEach((input) => {
  input.addEventListener("change", function () {
    let filesList = this.closest(".input-file").nextElementSibling;

    let existingFiles = Array.from(dt.items).map(
      (item) => item.getAsFile().name
    );

    if (dt.items.length >= max_files) {
      alert("Вы не можете загрузить больше 10 файлов");
      this.valie = "";
      return;
    }

    Array.from(this.files).forEach((file) => {
      if (!existingFiles.includes(file.name)) {
        let fileItem = document.createElement("li");
        fileItem.classList.add("input-file-list-item");

        let fileName = document.createElement("span");
        fileName.classList.add("input-file-list-name");
        fileName.textContent = file.name;

        let btn = this.parentNode.querySelector("span");
        btn.classList.add("btn-more");
        btn.textContent = "+ Добавить ещё";

        // let list = document.querySelector(".input-file-list");
        let list = this.parentNode.nextElementSibling;
        // console.log(
        //   this.parentNode.nextElementSibling,
        //   "this.parenNode.nextElementSibling"
        // );
        // console.log(this.parentNode, "this.parenNode");

        let removeLink = document.createElement("a");
        removeLink.href = "#";
        removeLink.textContent = "x";
        removeLink.classList.add("input-file-list-remove");

        removeLink.addEventListener("click", (e) => {
          e.preventDefault();
          removeFilesItem(file.name, this);
          if (list.querySelectorAll(".input-file-list-item").length === 0) {
            btn.classList.remove("btn-more");
            btn.textContent = "Выбрать файл";
          }
        });

        let fileSvg = document.createElement("div");
        fileSvg.classList.add("input-file-svg");

        // fileItem.appendChild(fileSvg);
        // fileItem.appendChild(fileName);
        // fileItem.appendChild(removeLink);
        // filesList.appendChild(fileItem);

        dt.items.add(file);
      }
    });

    this.files = dt.files;
  });
});

function removeFilesItem(name, input) {
  let filesList = input.closest(".input-file").nextElementSibling;
  let fileItems = filesList.querySelectorAll(".input-file-list-item");

  fileItems.forEach((item) => {
    let fileItemName = item.querySelector(".input-file-list-name").textContent;
    if (fileItemName === name) {
      filesList.removeChild(item);
    }
  });

  let newFiles = [];
  Array.from(dt.items).forEach((item) => {
    if (item.getAsFile().name !== name) {
      newFiles.push(item.getAsFile());
    }
  });

  dt.items.clear();
  newFiles.forEach((file) => dt.items.add(file));
  input.files = dt.files;
}

// загрузчик аватарки

document.getElementById("file-input").addEventListener("change", (event) => {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      const imagePreview = document.getElementById("image-preview");
      imagePreview.src = e.target.result;
      imagePreview.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});

// sidebar

document.addEventListener("DOMContentLoaded", function () {
  const navLinks = document.querySelectorAll(".nav__link");

  const forms = document.querySelectorAll(".main-container");

  navLinks.forEach((link) => {
    link.addEventListener("click", function (event) {
      event.preventDefault();
      const navItems = this.parentNode;

      navLinks.forEach((navLink) =>
        navLink.parentNode.classList.remove("active")
      );

      this.parentNode.classList.add("active");
      const target = this.getAttribute("data-target");

      forms.forEach((form) => form.classList.remove("active"));

      const activeForm = document.querySelector(`.main-container.${target}`);
      if (activeForm) {
        activeForm.classList.add("active");
      }
    });
  });
});

// exit

document.addEventListener("DOMContentLoaded", () => {
  const btnLogOut = document.getElementById("logOut");
  const popup = document.getElementById("popup");
  const yesBtn = document.getElementById("yesBtn");
  const noBtn = document.getElementById("noBtn");

  btnLogOut.addEventListener("click", () => {
    setTimeout(() => {
      popup.classList.add("visible");
    }, 10);
  });

  yesBtn.addEventListener("click", () => {

    axios.post('/api/auth/logout')
      .then(response => {
        window.location.href = `${window.location.origin}`;
      });
  });

  noBtn.addEventListener("click", () => {
    // alert("Вы не вышли из аккаунта");
    popup.classList.remove("visible");
  });
});

$(function () {

  let firstName = $(".main__list-person input[name='firstName']"),
    secondName = $(".main__list-person input[name='secondName']"),
    lastName = $(".main__list-person input[name='lastName']"),
    email = $(".main__list-person input[name='email']");

  let focusedBlock = undefined;

  $(".main__item.initials").on("click", function () {
    focusedBlock = $(this);
  });

  $(".main__item.mainInfo").on("click", function () {
    focusedBlock = $(this);
  });

  $(".document-uploads").on("click", function () {
    focusedBlock = $(this);
  });

  $(".main__item.name-scientist").on("click", function () {
    focusedBlock = $(this);
  });

  $(".main__item.diploma").on("click", function () {
    focusedBlock = $(this);
  })

  let url, data = undefined;

  $(document).on("mouseup", function (e) {
    console.log($(focusedBlock).has(e.target).length === 0, focusedBlock);
    // data, focusedBlock = undefined;

    if (focusedBlock != undefined && $(focusedBlock).has(e.target).length === 0
      && $(".main__list").has(e.target).length === 0
      && $(e.target).parents(".swal2-shown").length === 0) {

      switch ($(focusedBlock).prop("class")) {
        case "main__item initials":
          url = "/api/pa/users/personal_data/edit";
          data = {
            lastName: lastName.val(),
            firstName: firstName.val(),
            secondName: secondName.val(),
            email: email.val(),
          };
          break;

        case "main__item mainInfo":
          url = "/api/pa/users/main_info/edit";
          data = {
            birthday: $(".main__input-date").val(),
            study_place: $("input[name='studyPlace']").val(),
            specialty: $("input[name='specialty']").val(),
          }
          break;

        case "main__item name-scientist":
          url = "/api/pa/users/scientific_supervisor/edit";
          data = {
            year: $("#date-select").val(),
            scientific_head: $("input[name='fullNameScientist']").val(),
            post: $("input[name='positionScientist']").val(),
            scientific_degree: $("input[name='scientificDegree']").val(),
          }
          break;

        case "main__item diploma":
          url = "/api/pa/users/dissertation_work/edit";
          data = {
            topic: $("input[name='thesisTopic']").val(),
            year: $("#date-select").val(),
          }
          break;

        case "document-uploads":

          break;

        default:
          break;
      }

      axios.defaults.withXSRFToken = true;

      axios.put(`${window.location.origin}${url}`, data)
        .then(response => {
          data, url = undefined;
        })
        .catch(response => {
          Swal.fire({
            icon: "error",
            title: response.response.data.message,
          });
        });
    }
  });

  $(".main__item-files input[type='file']").on("change", function () {
    let formData = new FormData();

    Array.from(this.files).forEach(file => {
      formData.append($(this).prop("name"), file);
    });

    axios.post("/api/pa/users/files/upload", formData).then(response => {
      $(this).parents(".main__item-files").find(".input-file-list").append(`<li class='input-file-list-item'><div class='input-file-svg'></div><span class='input-file-list-name'>${response.data.image}</span><a class='input-file-list-remove'>x</a></li>`);
    });
  });

  $(".main__item.additional-files input[name='personalFiles']").on("change", function () {

    let formData = new FormData();

    Array.from(this.files).forEach(file => {
      formData.append(file.name, file)
    });

    formData.append("document", `${$(this).attr('aria-label')}`);
    formData.append("page", "Персональные данные");
    formData.append("year", $("#date-select").val());

    axios.post("/api/pa/users/files/upload", formData).then(response => {
      console.log(response);
      // $(this).parents(".inner-title").find(".input-file-list li").remove();
      response.data.documents.forEach(element => {
        $(this).parents(".inner-title").find(".input-file-list").append(`<li class='input-file-list-item'><div class='input-file-svg'></div><span class='input-file-list-name'>${element.path}</span><a class='input-file-list-remove'>x</a></li>`);
      });
    });

  });

  $(".input-file-list").on("click", ".input-file-list-remove", function () {

    let path = $(this).parents(".input-file-list-item").find(".input-file-list-name").text();
    let name = $(this).parents(".main__item-files").find("input[type='file']").prop("name");

    let data = {
      path: path,
      name: name,
    };

    axios.delete("/api/pa/users/files/delete", { data: data })
      .then(response => {
        Swal.fire({
          icon: "success",
          title: response.data.message,
        });
      })
      .catch(response => {
        Swal.fire({
          icon: "error",
          // title: response.response.data.message,
        });
      });
    $(this).parents(".input-file-list-item").remove();
  });

  $(".image-container input[type='file']").on("change", function () {

    let formData = new FormData();

    Array.from(this.files).forEach(file => {
      formData.append($(this).prop("name"), file)
    });

    axios.post("/api/pa/users/files/upload", formData).then(response => {
      $(".header__btn.user-btn img").attr("src", `/storage/${response.data.image}`);
    });
  });

  $(".achievement-item__input input[type='file']").on("change", function () {

    let clasName = $(this).parents("form").attr("class").replace(/main__form /, '');

    let formData = new FormData();

    Array.from(this.files).forEach(file => {
      formData.append(file.name, file)
    });

    formData.append("document", `${$(this).attr('aria-label')}`);

    switch (clasName) {
      case "achievement":
        formData.append("page", "Индивидуальные достижения");
        break;

      case "exam":
        formData.append("page", "Экзаменационная ведомость")
        break;
    }

    axios.post("/api/pa/users/files/upload", formData).then(response => {
      console.log(response);
      $(this).parents(".inner-title").find(".input-file-list li").remove();
      response.data.documents.forEach(element => {
        $(this).parents(".achievement-item__input").find(".input-file-list").append(`<li class='input-file-list-item'><div class='input-file-svg'></div><span class='input-file-list-name'>${element.path}</span><a class='input-file-list-remove'>x</a></li>`)
      });
    });
  });

});