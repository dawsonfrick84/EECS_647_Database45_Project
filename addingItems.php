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
$pass=$_POST["pass"];
$itemname = $_POST["ItemName"];
$price    = $_POST["ItemPrice"];
$isbn     = $_POST["ISBN"];
$instock  = $_POST["In-Stock"];
$picture  = $_POST["Picture"];
$description = $_POST["Description"];
$description = mysqli_real_escape_string($mysqli, $description);

$query = "SELECT username, password FROM Users ORDER by username";
$write=false;
if($result = $mysqli->query($query))
{
  while ($row = $result->fetch_assoc()) {
    if ($row["username"]==$username&&password_verify($pass, $row["password"])){
      //printf("Found user");
      $write=true;
    }
  }
  if ( $write==false)
  {
      echo "INVALID USERNAME";
  }
  else
  {
    $sql = "INSERT INTO Items (username, name, stock, price, picture, description, ISBN) VALUES ('$username', '$itemname', $instock, $price, '$picture', '$description', '$isbn')";
    if($mysqli->query($sql) === TRUE) {
      printf("Item added successfully<br>");
      echo"<script type='text/javascript'>location.href = 'itemAddSuccess.html';</script>";
    }
    else{
      echo("Error description: " . $mysqli -> error);
    }

  }
        $result->free();
  }
/* close connection */
$mysqli->close();
?>
