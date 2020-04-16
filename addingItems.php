<!-- <title>Adding Item Confirmation page</title>
<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");



/* check connection  */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}



$username = $_POST["user"];
$price    = $_POST["ItemPrice"];
$itemname = $_POST["ItemName"];
$isbn     = $_POST["ISBN"];
$instock  = $_POST["In-Stock"];
$picture  = $_POST["Picture"];
$description = $_POST["Description"];

 $result = $mysqli->query("SELECT username FROM Users WHERE username  = '$username'");

    if ($result->num_rows === 0)
    {
        echo "User's name not found.<br>";
    }
    else 
    {
      if ( $itemname == NULL && ($description == NULL || $description == "") && $instock < 0)
      {
          echo "INVALID ITEM. NEED MORE INFORMATION.<br>";
      }
      elseif (!$username == "" && $result->num_rows > 0)
      {
          $sql = $mysqli->query("INSERT INTO Items (name,stock,price,picture,description,ISBN) VALUES ('$itemname','$instock','$price','$picture','$description','$isbn')");
          echo "<h2>Item added.</h2><br>";$price
      }

    }

/* close connection */
$mysqli->close();
?> -->
