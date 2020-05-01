<title>View User's Reviews</title>
<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");

/* check connection  */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

 
 $username = $_POST['username'];
 $posts = "SELECT item_id, name, stock, price, ISBN, picture, description FROM Items WHERE username='$username'";
 echo "Here are the review(s) of the user you selected: ";
 echo "</br>";
 echo "</br>";
 echo "Username:  ";
 echo $username ;
 echo "</br>";
 echo "</br>";
 echo "<table border=\"2\">";
  if($result = $mysqli->query($posts)) {
    /* fetch associative array */
    while($row = $result->fetch_assoc()) 
    {

        $item_id = $row["item_id"];
        $item_name = $row["name"];
        $stock = $row["stock"];
        $price = $row["price"];
        $ISBN = $row["ISBN"];
        $picture = $row["picture"];
        $description = $row["description"];

      echo "<tr><td>";
            echo $item_id;
            echo "</td><td>";
            echo $item_name;
            echo "</td><td>";
            echo $stock;
            echo "</td><td>";
            echo $price;
            echo "</td><td>";
            echo $ISBN;
            echo "</td><td>";
            echo $picture;
            echo "</td><td>";
            echo $description;
            echo "</td><td>";
            echo "<input type='checkbox' name='checkbox[]' value='";
	    echo "'>";
      echo "</td></tr>";
    }
    $result->free(); /* free result set */
  }
 echo "</table>";
/* close connection */
$mysqli->close();
?>