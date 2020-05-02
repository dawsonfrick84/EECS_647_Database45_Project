<title>Delete Single Item</title>
<?php

$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");

if ($mysqli->connect_errno)
{
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

if(!isset($_GET['id']))
{
  echo "Error! Empty Id!";
}
else
{
  $id = $_GET['id'];
  
  $query = " DELETE FROM Items WHERE item_id = $id ";
  if ($result = $mysqli->query($query))
  {
    echo "Item was deleted successfully.";
  }
  else
  {
    printf("Error: " . $query . "<br>" . $conn->error);
  }
  echo "Here2";
}

$mysqli->close();
?>
