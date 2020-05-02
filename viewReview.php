<title>View Reviews</title>
<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");

/* check connection  */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
$permissions=$_POST['permissions'];

$username = $_POST['username'];
$pass   =  $_POST["pass"];
$item_id=0;
$item_id=$_POST["item_id"];
if($item_id==0){
  $item_id=$_GET["item_id"];
}

$overall_rating;
$sum_rating=0;
$count=0;

$pass_query = "SELECT username, password FROM Users WHERE username='$username'";
$write=false;
if($pass_result = $mysqli->query($pass_query))
{
while ($row = $pass_result->fetch_assoc())
    {
        if (password_verify($pass, $row["password"]))
            {
                $write=true;
            }
    }

}

   $items = "SELECT name FROM Items WHERE item_id=$item_id";
   if($item_result = $mysqli->query($items)) {
     while($item_row = $item_result->fetch_assoc())
     {
     $item_name=$item_row["name"];
    }
   }

  $reviews = "SELECT post_id, rating, content, username FROM Reviews WHERE item_id=$item_id";


  echo "Here are reviews for the item you selected: <b>". $item_name ."</b><br><br>";
  echo"<table border=\"2\"><tr>
        <th>Post ID</th>
        <th>Rating</th>
        <th>Review Content</th>
        <th>User</th>
  </tr>";

   if($result = $mysqli->query($reviews)) {
     /* fetch associative array */
     while($row = $result->fetch_assoc())
     {
       $post_id=$row["post_id"];
       $rating=$row["rating"];
       $content=$row["content"];
       $user=$row["username"];
       $count++;
       $sum_rating=$sum_rating+$rating;
       echo"<tr>
       <td style='text-align:center'>". $post_id ."</td>
       <td style='text-align:right'>". $rating ."</td>
       <td>". $content ."</td>
       <td>". $user ."</td>
       </tr>";
     }
     $result->free(); /* free result set */
     $overall_rating=$sum_rating/$count;
     echo"<b>Item Rating: ". $overall_rating ." out of 5</b>";
   }
   else{
     printf("Error: " . $reviews . "<br>" . $conn->error);
   }
/* close connection */
$mysqli->close();
?>
