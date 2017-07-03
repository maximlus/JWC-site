function showAdminForm(){
  var adminLogin = document.getElementById("adminform");
  var guestLogin = document.getElementById("guestform");
  // Make adminLogin viewable and apply animation class
  adminLogin.style.display = "inline-grid";
  adminLogin.className += " bounceInDown";
  // Hide guestLogin element
  guestLogin.style.display = "none";
  guestLogin.classList.remove("bounceInDown");
}


//TODO vvvvv Finish this! vvvvv
function showGuestForm(){
  var adminLogin = document.getElementById("adminform");



  adminLogin.style.display = "none";
  adminLogin.classList.remove("bounceInDown");
}

function test(){

}

function testAPI(){
  var xhr = new XMLHttpRequest();
  xhr.open("GET","/test");
  xhr.onreadystatechange = function(){
    if(xhr.readyState === 4){
      console.log(xhr.responseText);
    }
  }
  xhr.send();
}



document.getElementById("btnLogin").addEventListener("click", showAdminForm);
document.getElementById("btnSignup").addEventListener("click",testAPI);
