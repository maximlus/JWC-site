/* jshint browser: true */

function showAdminForm() {
  const adminLogin = document.getElementById("adminform");
  const guestLogin = document.getElementById("guestform");

  adminLogin.style.display = "inline-grid";
  adminLogin.className += " bounceInDown";
  guestLogin.style.display = "none";
  guestLogin.classList.remove("bounceInDown");
}

/*
* Placeholder function untill Guest form is implemented
*/

function guestLoginTEST(guestName) {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/api/user/login?user=" + guestName);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        console.log(guestName + " has logged in sucessfully!");
      } else if (xhr.status === 404) {
        console.log("Login Failure!");
      }
    }
  };
  xhr.send();
}


/*
*vvvvv Finish this! vvvvv
*/

function showGuestForm() {
  const adminLogin = document.getElementById("adminform");

  adminLogin.style.display = "none";
  adminLogin.classList.remove("bounceInDown");
}

function getViewCount() {
  const viewCounter = document.getElementById("viewcounter");
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/api/viewcounter/new");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      viewCounter.innerText = xhr.responseText;
    }
  };
  xhr.send();
}

function testAPI() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "/test");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      console.log(xhr.responseText);
    }
  };
  xhr.send();
}

getViewCount();
document.getElementById("btnLogin").addEventListener("click", showAdminForm);
document.getElementById("btnSignup").addEventListener("click", testAPI);
