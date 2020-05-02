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
$review_to_delete=$_GET["to_delete_id"];

if($review_to_delete>0){
  $delete = "DELETE FROM Reviews WHERE post_id=$review_to_delete";
  if($delete_result = $mysqli->query($delete))
  {
    echo"<html>
        <head>
          <title>Delete Successfully</title>
        </head>
    <body>
    <h1>Deleted Review ".$review_to_delete." Successfully!</h1>
    <h3><a href='index.html'>Return Home (Create User)</a></h3>
    <h3><a href='buyItems.php'>Shop School Supplies and Items</a></h3>
    <h3><a href='addingItems.html'>Add Items to the Store</a></h3>
    <h3><a href='selectUserItems.php'>View Your Items and Delete</a></h3>
    <h3><a href='selectUserOrders.php'>View Your Orders and Delete</a></h3>
    <h3><a href='reviews.php'>Reviews</a></h3>
    <link rel='stylesheet' type='text/css' href='style.css?v={random number/string}'>
    </body>
    </html>";
  }
  else{
    printf("Error: " . $delete . "<br>" . $conn->error);
    echo"<h1>Delete unsuccessful</h1>
    <h2><a href='javascript:history.back()'>Go Back</a></h2>";
  }
}

$pass_query = "SELECT username, password FROM Users WHERE username='$username'";
$write=false;
if($pass_result = $mysqli->query($pass_query))
{
while ($row = $pass_result->fetch_assoc())
    {
        if (password_verify($pass, $row["password"]))
            {

             $reviews = "SELECT post_id, rating, content, username, item_id FROM Reviews";


             echo "Here is every review: </b><br><br>";
             echo"<table border=\"2\"><tr>
                   <th>Delete</th>
                   <th>Post ID</th>
                   <th>Item</th>
                   <th>Rating</th>
                   <th>Review Content</th>
                   <th>User</th>
             </tr>";

              if($result = $mysqli->query($reviews)) {
                /* fetch associative array */
                while($row = $result->fetch_assoc())
                {
                  $item_id=$row["item_id"];
                  $post_id=$row["post_id"];
                  $rating=$row["rating"];
                  $content=$row["content"];
                  $user=$row["username"];

                  $items = "SELECT name FROM Items WHERE item_id=$item_id";
                  if($item_result = $mysqli->query($items)) {
                    while($item_row = $item_result->fetch_assoc())
                    {
                    $item_name=$item_row["name"];
                   }
                  }

                  echo"<td><button onclick=window.location.href='deleteReview.php?to_delete_id=".$post_id."'>Delete</button></td>
                  <td style='text-align:center'>". $post_id ."</td>
                  <td>".$item_name."</td>
                  <td style='text-align:right'>". $rating ."</td>
                  <td>". $content ."</td>
                  <td>". $user ."</td>

                  </tr>";
                }
                $result->free(); /* free result set */
                echo"</table>";
              }
              else{
                printf("Error: " . $reviews . "<br>" . $conn->error);
              }
            }
        else{

        }
        echo"<h3><a href='index.html'>Return Home (Create User)</a></h3>
        <h3><a href='buyItems.php'>Shop School Supplies and Items</a></h3>
        <h3><a href='addingItems.html'>Add Items to the Store</a></h3>
        <h3><a href='selectUserItems.php'>View Your Items and Delete</a></h3>
        <h3><a href='selectUserOrders.php'>View Your Orders and Delete</a></h3>
        <h3><a href='reviews.php'>Reviews</a></h3>";
    }

}


/* close connection */
$mysqli->close();
?>
