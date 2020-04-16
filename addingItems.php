<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");



/* check connection  */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s<br>", $mysqli->connect_error);
    exit();
}
else{
  //printf("Connection to mySQL successful!");
}



$username = $_POST["user"];
$price    = $_POST["ItemPrice"];
$itemname = $_POST["ItemName"];
$isbn     = $_POST["ISBN"];
$instock  = $_POST["In-Stock"];
$picture  = $_POST["Picture"];
$description = $_POST["Description"];

$write=true;
    if($result = $mysqli->query("SELECT username FROM Users"))
    {
    while ($row = $result->fetch_assoc()) {
        if ($row["username"]==$username){
          $write=true;
        }
      }

      if ( $write==false)
      {
          echo "INVALID USERNAME";
      }
      else
      {
        if($mysqli->query("INSERT INTO Items (name, stock, price, picture, description, ISBN) VALUES ('$itemname', $instock, $price,'$picture','$description', '$isbn')") === TRUE) {
        echo "<h2>Item added.</h2><br>"; //$price
        }
        else{
        printf("Error: " . $sql . "<br>" . $conn->error);
        }

      }

    $result->free();
    }
/* close connection */
$mysqli->close();
?>
