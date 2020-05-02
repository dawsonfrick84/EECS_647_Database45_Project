<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");
if ($mysqli->connect_errno) {
    printf("Connect failed: %s<br>", $mysqli->connect_error);
    exit();
}
else{
  //printf("Connection to mySQL successful!");
}
$query = "SELECT item_id, name, stock, price, rating, picture, description FROM Items ORDER by item_id";
echo"
<html>
    <head>
      <title>Store</title>
    </head>
<body>

<script src='purchaseCheck.js'></script>
<center><h1><center>Welcome to the School Supplies Store</center></h1></center>
<center><h3><a href='index.html'>Return home</a>&emsp;
<a href='addingItems.html'>Add Items to the Store</a></h3></center><br>
<center><h3><center>Check out our selection of school supplies and textbooks</center></h3></center><br>
<div id='items'>
  <form id='1' action='showOrder.php' method='post' onsubmit='return checkPurchase();'>";

    if ($result = $mysqli->query($query)) {
      //printf("Connection success<br>Passed in username: %s<br>", $user);
        while ($row = $result->fetch_assoc()) {
          echo"
          <figure id='1'>
           <b>Item ".$row["item_id"].": ".$row["name"]." </b><br>
            <img class='item_pic' src='".$row["picture"]."' width='125' height='125'><br>
              <input type='checkbox' class='item' id='".$row["item_id"]."' name='".$row["item_id"]."' value='".$row["item_id"]."' >$".$row["price"]."<br>
              Quantity: <input type='number' class='quantity' id='q".$row["item_id"]."' name='q".$row["item_id"]."' value='q".$row["item_id"]."' step=1 min='1' max='".$row["stock"]."' size=3><br>
              Description: ".$row["description"]." <br>

              <a href='viewReview.php?item_id=".$row["item_id"]."'> View Reviews for this Item</a>

            </figure>";
          }
    }
    echo"
  </div>
  <div class='clear'></div><br><br><br>
  <p><b>Checkout</b></p>
  <b>Username:&nbsp&nbsp</b><input type='text' id='user' name='user' required><br><br>
  <b>Password:&nbsp&nbsp</b><input type='password' id='pass' name='pass' required><br><br>
  <b>Street Address:&nbsp&nbsp</b><input type='text' id='address' name='address' required>
  <b>Zip Code:<b>&nbsp&nbsp</b><input type='text' id='zip' name='zip' required>
  <br><br>
  <br>

  <p><b>Payment Options:</b> (for the sake of this project, don't enter real information. It won't be stored just in case)</p>
  <input type='radio' id='credit' name='payment' value='credit' unchecked>Credit Card
  &emsp;&emsp;Number: <input type='number' id='ccnum' name='ccnum'><br>
  <input type='radio' id='debit' name='payment' value='debit' unchecked>Debit Card
  &emsp;&emsp;Number: <input type='number' id='dcnum' name='dcnum'><br>
  <input type='radio' id='paypal' name='payment' value='paypal' unchecked>Pay Pal
  &emsp;&emsp;&emsp;<input type='button' style='background-color:gold;color:blue;' id='pp' name='pp' value='PayPal'><br>

  <p><b>Shipping Options:</b></p>
  <input type='radio' id='shipping1' name='shipping' value='free' unchecked>Free 5-Day Shipping<br>
  <input type='radio' id='shipping2' name='shipping' value='three' unchecked>$3.00 - 3-Day Shipping<br>
  <input type='radio' id='shipping3' name='shipping' value='overnight' unchecked>$25.00 - Overnight Shipping<br><br><br>
  <div id='checkout'>
    <center><input type='submit' value='Submit to Checkout'>
    </form>
    <button onclick='reset()'>Reset Inputs</button></center>
  </div>
<br><br><br><br><br><br><br><br><br>
</body>
</html>
";
 ?>
