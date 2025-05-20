window.onload = function () {
  var message = localStorage.getItem("signupSuccess");
  if (message) {
    alert(message);
    localStorage.removeItem("signupSuccess");
  }

  document.getElementById("loginBtn").onclick = function () {
  var email = document.getElementById("email").value.toLowerCase().trim();
    var password = document.getElementById("password").value;

    var emailError = document.getElementById("emailError");
    var passwordError = document.getElementById("passwordError");
    var formError = document.getElementById("formError");

    emailError.innerHTML = "";
    passwordError.innerHTML = "";
    formError.innerHTML = "";

    var valid = true;

    if (email === "") {
      emailError.innerHTML = "Email is required.";
      valid = false;
    }

    if (password === "") {
      passwordError.innerHTML = "Password is required.";
      valid = false;
    }

    if (!valid) {
      formError.innerHTML = "Please fix the errors above.";
      return false;
    }

    if (email === "user" && password === "user") {
      window.location.href = "home.html";
    } else if (email === "admin" && password === "admin") {
      window.location.href = "admin.html";
    } else {
      formError.innerHTML = "Invalid email or password!";
    }

    return false;
  };
};
