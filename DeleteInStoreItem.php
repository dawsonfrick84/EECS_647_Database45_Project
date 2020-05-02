<title>Delete User's Item confirmation page</title>
<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");

/* check connection  */
if ($mysqli->connect_errno) 
{
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

  $ItemsGonnaDelete = $_POST["checkbox[]"];

/*  $attempt = $_POST["checkbox[]"];
  if(empty($attempt))
  {
    echo "Nope";
  }
  else
  {
    $N = count($attempt);
    echo "You selected $N options: ";
    for ($i = 0; $i < $N; $i++)
    {
      echo($attempt[$i] . " ");
    }
  }
 */

  if($ItemsGonnaDelete == FALSE) 
  {
    echo "Please select at least 1 item to delete.<br>";
  } 
  
  if ($ItemsGonnaDelete == TRUE) 
  {
    foreach($ItemsGonnaDelete as $item_id) 
    {
      $query = "DELETE FROM Items WHERE item_id = '$item_id'";
      
      if($mysqli->query($query) === TRUE) 
      {
        echo "Post ID " .$contents. " has been deleted";
        echo "<br>";
      } 
      else 
      {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
    }
  }
  $mysqli->close(); /* close connection */?>
