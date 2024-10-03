const btnChange1 = document.getElementById("changeForm1");
const btnChange2 = document.getElementById("changeForm2");
const logInForm = document.getElementById("showLogIn");
const signInForm = document.getElementById("showSingIn");
const container = document.querySelector(".auth__container");

btnChange1.addEventListener("click", (e) => {
  e.preventDefault();

  logInForm.classList.remove("active");

  setTimeout(() => {
    signInForm.classList.add("active");
  }, 1000);
});

btnChange2.addEventListener("click", (e) => {
  e.preventDefault();

  signInForm.classList.remove("active");

  setTimeout(() => {
    logInForm.classList.add("active");
  }, 1000);
});

document.querySelectorAll(".auth__input").forEach((input) => {
  input.addEventListener("input", function () {
    const span = this.nextElementSibling;
    if (this.value.trim()) {
      input.style.color = "#000";
      span.classList.add("visible");
    } else {
      input.style.color = "#fff";
      span.classList.remove("visible");
    }
  });
});

$(function () {
  $("#formSignIn").on("submit", function (e) {
    e.preventDefault();
    let firstName = $(".auth__list input[name='lastName']").val();
    let secondName = $(".auth__list input[name='secondName']").val();
    let lastName = $(".auth__list input[name='lastName']").val();
    let email = $(".auth__list input[name='email']").val();
    let birthday = $(".auth__list input[name='birthday']").val();
    let password = $(".auth__list input[name='password']").val();
    let retypePassword = $(".auth__list input[name='retypePassword']").val();

    let obj = {
      firstName: firstName,
      secondName: secondName,
      lastName: lastName,
      email: email,
      birthday: birthday,
      password: password,
      retypePassword: retypePassword,
    }

    $.ajax({
      type: "POST",
      url: "/api/auth/signin",
      data: obj,
      dataType: "json",
      success: function (response) {
        Swal.fire({
          icon: 'success',
          title: response.message,
          confirmButtonText: 'Ok',
        });
      },
      error: function (response) {
        Swal.fire({
          icon: 'error',
          title: response.responseJSON.message,
          confirmButtonText: 'Ok',
        });
      }
    });


  });

  $("#formLogIn").on("submit", function (e) {
    e.preventDefault();

    axios.defaults.withCredential = true;
    axios.defaults.withXSRFToken = true;

    axios.get('/sanctum/csrf-cookie',).then(response => {
      const data = {
        email: $(this).find("input[type='email']").val(),
        password: $(this).find("input[type='password']").val(),
      };
      axios.post('/api/auth/login', data)
        .then(response => {
          window.location.href = `/pa/`;
        })
        .catch(response => {
          Swal.fire({
            icon: "error",
            title: response.response.data.message,
          });
        });
    });
  });

});