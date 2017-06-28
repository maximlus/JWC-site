/*
  GET on /test to check if PHP is currently serving API requests properly.
*/

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
function showadminform(){
	
}


document.getElementById("btnSignup").addEventListener("click",testAPI);
