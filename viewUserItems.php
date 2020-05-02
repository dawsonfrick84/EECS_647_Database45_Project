<title>View User's Items</title>
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
if($write==true){
  $posts = "SELECT item_id, name, stock, price, ISBN, picture, description FROM Items WHERE username='$username' ORDER BY item_id";
  if($permissions==true){
    $posts = "SELECT item_id, name, stock, price, ISBN, picture, description, username FROM Items ORDER BY item_id";
  }

if($permissions==true)
{
  echo"Here are the items of ALL users:";
}
else
{
  echo "Here are the items of the user you selected:";
}
  echo"</br>
  </br>
  Username:
  ". $username . "
  </br>
  </br>
  <table border=\"2\">
         <tr>
               <th></th>";
               if($permissions==true){
                 echo"<th>User</td>";
               }
               echo"<th>Item Id</th>
               <th>Item Name</th>
               <th>Stock</th>
               <th>Price</th>
               <th>ISBN</th>
               <th>Picture</th>
         </tr>";
   if($result = $mysqli->query($posts))
   {
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

       echo"<tr><td td style='text-align:center'>
              <button onclick=window.location.href='deleteItem.php?id=".$item_id."'>Delete</button>";
             if($permissions==true){
               echo"<td>". $row["username"] ." </td>";
             }
             echo"</td><td>
             ". $item_id ."
             </td><td>
             ". $item_name ."
             </td><td>
             ". $stock ."
             </td><td>
             ". $price ."
             </td><td>
             ". $ISBN ."
             </td><td>
             <img class='item_pic' src='".$row["picture"]."' width='75' height='75'>

             </td>
             </tr><tr><td colspan='7'>
             ". $description ."
       </td></tr>";
     }
     $result->free(); /* free result set */
   }
  echo"</table>";

  //echo("<button onclick=\"location.href='DeleteInStoreItem.php'\">Delete Checked Item(s)</button>");
}
else
{
  echo"<h1>The password you entered is incorrect!</h1>
  <h2><a href='javascript:history.back()'>Go Back</a></h2>
  ";
}
/* close connection */
$mysqli->close();
?>
