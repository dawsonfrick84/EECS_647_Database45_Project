<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");
$user=$_POST["user"];
$email=$_POST["email"];
$pass=$_POST["pass"];
$shipping=$_POST["shipping"];
$cost = 0;
  echo"
  <html>
      <head>
        <title>Order Created</title>
      </head>
  <body>
  ";
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s<br>", $mysqli->connect_error);
      exit();
  }
  else{
    //printf("Connection to mySQL successful!");
  }

  $query = "SELECT username, password FROM Users ORDER by username";
  $found=FALSE;

  if ($result = $mysqli->query($query)) {
    //printf("Connection success<br>Passed in username: %s<br>", $user);
      while ($row = $result->fetch_assoc()) {
          if ($row["username"]==$user&&password_verify($pass, $row["password"]) ){
            $found=TRUE;
          }
      }
      if ($found==FALSE){
        echo"<h1>User not found in the database...</h1>
        <h2><a href='index.html'>Create a New User</a></h2>
        <h1>Or maybe you entered the wrong password</h1>
        <h2><a href='javascript:history.back()'>Go Back</a></h2>
        ";
      }
      else {
        //printf("User and password exists!");
        echo"<html>
        <head>
          <title>Receipt</title>
        <head>
        <body>
          <h1>Order Confirmed!</h1>
          <h2>Order made by user:  " . $user . "!</h2>
          <h1>Receipt</h1>

        <table cellspacing='7.5'>
        <tr>
        <th>&nbsp&nbsp&nbsp</th>
        <th>Quantity</th>
        <th>Cost Per Item</th>
        <th>Sub Total</th>
        </tr>
        ";
        echo"<tr><th>Shipping</th>";

        if($shipping=="free"){
          echo"
          <td colspan='2'>5-Day Shipping</td>
          <td>0.00</td>
          </tr>";
        }
        if($shipping=="three"){
          echo"
          <td colspan='2'>3-Day Shipping</td>
          <td>3.00</td>
          </tr>";
          $cost=$cost+3.00;
        }
        if($shipping=="overnight"){
          echo"
          <td colspan='2'>Overnight Shipping&nbsp&nbsp&nbsp&nbsp</td>
          <td>25.00</td>
          </tr>";
          $cost=$cost+25.00;
        }

        echo"<tr><td colspan='3'><b>TOTAL COST:&nbsp&nbsp&nbsp&nbsp</b></td>
        <td><b>&nbsp&nbsp&nbsp$" . $cost . "</b></td>
        </tr>
        </table>
        <br><br><button onclick='printReceipt()'><b>Print Receipt</b></button>
        <script>
        function printReceipt() {
          window.print();
        }
        </script>
        <br><br>
        <h3><a href='index.html'>Return to Home Page</a></h3>
        <h3><a href='buyItems.php'>Shop For More School Supplies and Items</a></h3>
        <h3><a href='addingItems.html'>Add Items to the Store</a></h3>
        ";
      }


      $result->free();
  }



  $mysqli->close();

?>
