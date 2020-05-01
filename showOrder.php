<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");
$user=$_POST["user"];
$pass=$_POST["pass"];
$street=$_POST["address"];
$zip=$_POST["zip"];
$address=$street . ", " . $zip;
$shipping=$_POST["shipping"];
$payment=$_POST["payment"];
$cost = 0.00;

for($i=0; $i<500; $i++){
  $item_id[$i]=$_POST[""+$i];
  $item_quantity[$i]=$_POST["q" . $i];
  // printf("item id: %s<br>", $item_id[$i]);
  // printf("item q: %s<br>", $item_quantity[$i]);
}


if ($mysqli->connect_errno) {
    printf("Connect failed: %s<br>", $mysqli->connect_error);
    exit();
}
else{
  //printf("Connection to mySQL successful!");
}

$success=false;
$order_id=rand(100000000, 999999999);
while($success=false){
  $query1="SELECT order_id FROM Orders WHERE order_id=$order_id";
  if ($result1 = $mysqli->query($query)) {
  }
  else{
    printf("Error retrieving order_ids");
  }
  if(mysqli_num_rows($result1)==0){
    $success=true;
    $result1->free();
  }
  else{
    $order_id=rand(100000000, 999999999);
  }
}
printf("%s", $order_id);

  echo"
  <html>
      <head>
        <title>Order Created</title>
      </head>
  <body>
  ";
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
          <h1><u>Receipt</u></h1>

        <table cellspacing='7.5'>
        <tr>
        <th>&nbsp&nbsp&nbsp</th>
        <th>Quantity</th>
        <th>Cost Per Item</th>
        <th>Sub Total</th>
        </tr>
        ";

        $query2 = "SELECT item_id, name, price, stock FROM Items ORDER by item_id";

        if ($result2 = $mysqli->query($query2)) {
          //printf("Connection success<br>Passed in username: %s<br>", $user);
            while ($row2 = $result2->fetch_assoc()) {
              for($i=$row2["item_id"]; $i<=$row2["item_id"]; $i++){
                if($row2["item_id"]==$item_id[$i]){
                  echo"
                  <tr><th style='text-align:left'>". $row2["name"] ."</th>
                  <td style='text-align:right'> ". $item_quantity[$i] ." </td>
                  <td style='text-align:right'> ". $row2["price"] ." </td>
                  <td style='text-align:right'> ". $row2["price"]*$item_quantity[$i] ." </td>
                  </tr>
                  ";
                  $cost=$cost +  $row2["price"]*$item_quantity[$i];
                  $query3 = "UPDATE Items SET stock=stock-$item_quantity[$i] WHERE item_id=$i";
                  if ($result3 = $mysqli->query($query3)) {
                    printf("Updated stock");
                  }
                  else{
                    printf("ERROR: Could not update stock!");
                  }
                  $query4="INSERT INTO Purchases (order_id, item_id, quantity) VALUES ($order_id, $i, $item_quantity[$i])";
                  if ($mysqli->query($query4) === TRUE) {
                    printf("Purchase added successfully<br>");
                  }
                  else {
                    printf("Error: " . $query4 . "<br>" . $conn->error);
                  }
                }
              }
            }
        }
        else{
          printf("Couldn't retrieve item info");
        }
        echo"<tr><th style='text-align:left'>Shipping</th>";
        $shipping_cost=0;
        if($shipping=="free"){
          echo"
          <td colspan='2'>5-Day Shipping</td>
          <td style='text-align:right'>0.00</td>
          </tr>";
        }
        if($shipping=="three"){
          echo"
          <td colspan='2'>3-Day Shipping</td>
          <td style='text-align:right'>3.00</td>
          </tr>";
          $cost=$cost+3.00;
          $shipping_cost=3.00;
        }
        if($shipping=="overnight"){
          echo"
          <td colspan='2'>Overnight Shipping</td>
          <td style='text-align:right'>25.00</td>
          </tr>";
          $cost=$cost+25.00;
          $shipping_cost=25.00;
        }

        echo"<tr><br></tr><tr><br></tr>
        <tr><th style='text-align:left' colspan='3'><b><u>TOTAL COST:</b></u></th>
        <td style='text-align:right'><u><b>$" . $cost . "</b></u></td>
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
        $query5="INSERT INTO Orders (order_id, user, total, shipping, address, payment) VALUES ($order_id, '$user', $cost, $shipping_cost, '$address', '$payment')";
        if ($mysqli->query($query5) === TRUE) {
          printf("Order added successfully<br>");
        }
        else {
          printf("Error: " . $query5 . "<br>" . $conn->error);
        }
        $_SESSION['post_data'] = $_POST;
        header('Location: receipt.php', true, 307);
      }


      $result2->free();
      $result->free();
  }



  $mysqli->close();

  exit;
?>
