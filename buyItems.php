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

<script src='checkForm.js'></script>
<center><h1><center>Welcome to the School Supplies Store</center></h1></center><br>
<center><h3><center>Check out our selection of school supplies and textbooks</center></h3></center><br>
<div id='items'>
  <form action='showOrder.php' method='post' onsubmit='return checkSubmit();'>";

    if ($result = $mysqli->query($query)) {
      //printf("Connection success<br>Passed in username: %s<br>", $user);
        while ($row = $result->fetch_assoc()) {
          echo"
          <figure id='1'>
           <b>Item ".$row["item_id"].": ".$row["name"]." </b><br>
            <img class='item' src='".$row["picture"]."' width='125' height='125'><br>
              <input type='checkbox' id='".$row["item_id"]."' name='".$row["name"]."' value='".$row["item_id"]."'>$".$row["price"]."<br>
              Quantity: <input type='number' id='q".$row["item_id"]."' name='q".$row["name"]."' value='q".$row["item_id"]."' min='1' max='".$row["stock"]."' size=3><br>
              Description: ".$row["description"]." <br>
            </figure>";
          }
    }
    echo"
  </div>
  <div class='clear'></div><br><br><br>
  <p><b>Checkout</b></p>
  <b>Username:&nbsp&nbsp</b><input type='text' id='user' name='user'><br><br>
  <b>Password:&nbsp&nbsp</b><input type='password' id='pass' name='pass'><br><br><br>
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
