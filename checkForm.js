function checkSubmit(){
    var valid=false;
    if(document.getElementById("user").value.length>=5){
      if(document.getElementById("pass").value.length>=5){
        if(document.getElementById("pass").value==document.getElementById("conf_pass").value){
          valid=true;
        }
      }
    }

    if(valid==true){
      return true;
    }
    else if(document.getElementById("user").value.length<5){
      alert("Username must be five or more characters");
      return false;
      returnToPreviousPage();
    }
    else if(document.getElementById("pass").value.length<5){
      alert("Password must be five or more characters");
      return false;
      returnToPreviousPage();
    }
    else if(document.getElementById("pass").value!=document.getElementById("conf_pass").value){
      alert("Passwords do not match");
      return false;
      returnToPreviousPage();
    }
    else{
      alert("Please enter all required fields");
      return false;
      returnToPreviousPage();
    }
}

function reset(){
      document.getElementById("user").value = "";
      document.getElementById("pass").value = "";
      document.getElementById("conf_pass").value = "";
      document.getElementById("email").value = "";
}
