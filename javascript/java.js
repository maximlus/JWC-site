function main(){
	//load some PHP stuff.
	//Load in a video from JWC1/2/3. @ random.
	//Load in List of hourses depeding what video is loaded. 
}

function validateForm() {
  var x = document.forms["Login"]["LoginBox"].value;
  if (x == "") {
      alert("Name must be filled out");
      return false;
  }else{
    if(x=="ADMIN"){
      window.location.href = "192.168.0.47/admin.html";
    }
  }
}
