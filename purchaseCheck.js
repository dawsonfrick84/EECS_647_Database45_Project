function checkPurchase(){
    var valid=false;
    var shipping=false;
    var selected_items=false;
    var payment=false;

    var x = document.getElementsByClassName("item");
    var y = document.getElementsByClassName("quantity");
    var i;
    for (i = 0; i < x.length; i++) {
      if(x[i].checked==true){
        if(y[i].value>0){
          selected_items=true;
        }
        else{
          selected_items=false;
        }
      }

    }

    if(document.getElementById("user").value.length>=5){
      if(document.getElementById("pass").value.length>=5){
        {
          valid=true;
        }
      }
    }

    if(document.getElementById("shipping1").checked==true){
      shipping=true;
    }
    if(document.getElementById("shipping2").checked==true){
      shipping=true;
    }
    if(document.getElementById("shipping3").checked==true){
      shipping=true;
    }

    if(document.getElementById("credit").checked==true){
      payment=true;
    }
    if(document.getElementById("debit").checked==true){
      payment=true;
    }
    if(document.getElementById("paypal").checked==true){
      payment=true;
    }

    if(valid&&shipping&&selected_items&&payment){
      return true;
    }
    else if(selected_items==false){
      alert("You must select at least 1 item and have a quantity for each item you select!");
      return false;
    }
    else if(shipping==false&&payment==false){
      alert("Must select shipping and payment methods!");
      return false;
    }
    else if(shipping==false){
      alert("Must select shipping method!");
      return false;
    }
    else if(payment==false){
      alert("Must select payment method!");
      return false;
    }
    else if(document.getElementById("user").value.length<5){
      alert("Username must be five or more characters");
      return false;
    }
    else if(document.getElementById("pass").value.length<5){
      alert("Password must be five or more characters");
      return false;
    }
    else{
      alert("Please enter all required fields");
      return false;
    }
}

function reset(){
      document.getElementById("user").value = "";
      document.getElementById("pass").value = "";
      document.getElementById("shipping1").checked=false;
      document.getElementById("shipping2").checked=false;
      document.getElementById("shipping3").checked=false;
      document.getElementById("debit").checked=false;
      document.getElementById("credit").checked=false;
      document.getElementById("paypal").checked=false;
      var x = document.getElementsByClassName("item");
      var i;
      for (i = 0; i < x.length; i++) {
        x[i].checked=false;
      }
}
