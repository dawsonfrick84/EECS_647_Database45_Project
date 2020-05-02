<title>Delete Order</title>
<?php

$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");

if ($mysqli->connect_errno)
{
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

if(!isset($_GET['id']))
{
  echo "Error! Empty Id!<br>";
}
else
{
  $id = $_GET['id'];
  echo "ID is $id";

  $query = " DELETE FROM Orders WHERE order_id = $id ";
  $query2 = " DELETE FROM Purchases WHERE order_id = $id ";
  if ($result = $mysqli->query($query))
  {
    if ($result2 = $mysqli->query($query2))
    {
      echo "Order was deleted successfully.";
      header('Location: deleteSuccessful.html');
    }
  }
  else
  {
    printf("Error: " . $query . "<br>" . $conn->error);
  }

}

$mysqli->close();
?>
