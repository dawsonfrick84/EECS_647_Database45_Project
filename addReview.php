<title>Add Review</title>
<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");

/* check connection  */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$username=$_POST['username'];
$pass=$_POST["pass"];
$item_name=$_POST["item_name"];
$rating=$_POST["rating"];
$review=$_POST["review"];
$review = mysqli_real_escape_string($mysqli, $review);
$item_id=0;

echo"<h1>$username";
echo"'s review of ";
echo"$item_name</h1><br>";
$item_query = "SELECT item_id FROM Items WHERE name='$item_name'";
if($item_result = $mysqli->query($item_query)){
  while ($row = $item_result->fetch_assoc())
  {
    $item_id=$row["item_id"];
  }
}
else{
  printf("Error: " . $item_query . "<br>" . $conn->error);
}

$pass_query = "SELECT username, password FROM Users WHERE username='$username'";
if($pass_result = $mysqli->query($pass_query))
{
  while ($row2 = $pass_result->fetch_assoc())
  {
      if (password_verify($pass, $row2["password"]))
      {
        $query="INSERT INTO Reviews (rating, content, item_id, username) VALUES ($rating, '$review', $item_id, '$username') ";
        echo"<br>$query<br>";
        if ($mysqli->query($query) === TRUE) {
          printf("Review added successfully<br>");
          echo"<script type='text/javascript'>location.href = 'addReview.html';</script>";
        }
        else {
          printf("Error: " . $sql . "<br>" . $conn->error);
        }
      }
      else{
        echo"<h2>Your password/username is incorrect!</h2>
        <h2><a href='javascript:history.back()'>Go Back</a></h2>
        ";
      }
  }
}
else{
  printf("Error: " . $pass_query . "<br>" . $conn->error);
}

if($write==true) {
  printf($user_name);
}

/* close connection */
$mysqli->close();
?>
