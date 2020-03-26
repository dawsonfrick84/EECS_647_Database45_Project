<?php
echo"
<html>
    <head>
      <title>Store</title>
    </head>
<body>
<link rel='stylesheet' type='text/css' href='style.css'>
<script src='checkForm.js'></script>
<center><h1><center>Welcome to the School Supplies Store</center></h1></center><br>
<center><h3><center>Check out our selection of school supplies and textbooks</center></h3></center><br>
<div id='items'>
  <form action='showOrder.php' method='post' onsubmit='return checkSubmit();'>
    <center><figure>
          <center><b>Item1</b></center>
          <img class='item' src='' width='200' height='200'><br>
            <input type='checkbox' id='1' name='1' value='item1'>$3.99<br>
            Quantity: <input type='number' id='q1' name='q1' value='q1' min='1' max='99' size=3><br>
    </figure></center>
    <center><figure>
        <form action='showOrder.php' method='post'>
          <center><b>item2</b></center>
          <img class='item' src='' width='200' height='200'><br>
            <input type='checkbox' id='2' name='2' value='item2'>$9.99<br>
            Quantity: <input type='number' id='q2' name='q2' value='q2' min='1' max='99' size=3><br>
    </figure></center>
  </div>
  <div class='clear'></div><br><br><br>
  <p><b>Checkout</b></p>
  <b>Username (email):&nbsp&nbsp</b><input type='email' id='user' name='user'><br><br>
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
