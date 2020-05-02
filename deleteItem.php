<title>Delete Single Item</title>
<?php

if ($mysqli->connect_errno)
{
  printf("Connect failed: %s\n", $mysqli->connect_error);
  exit();
}

if(empty($_GET["id"]))
{
  echo "Error! Empty Id!";
}
else
{
  echo "Id is $id";
}

$mysqli->close();
?>
