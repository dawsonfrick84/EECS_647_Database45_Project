<title>View User's Orders</title>
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
  $posts = "SELECT order_id, user, total, shipping, address, payment FROM Orders WHERE user='$username' ORDER BY order_id";
  if($permissions==true){
    $posts = "SELECT order_id, user, total, shipping, address, payment FROM Orders ORDER BY order_id";
  }

if($permissions==true){
  echo"Here are the orders of ALL users:";
}
else{
  echo "Here are the orders of the user you selected:";
}
  echo"</br>
  </br>
  Username:
  ". $username . "
  </br>
  </br>
  ";

   if($result = $mysqli->query($posts)) {
     /* fetch associative array */
     while($row = $result->fetch_assoc())
     {
       echo"<table border=\"2\"><tr>";
             if($permissions==true){
               echo"<th></th>";
               echo"<th>User</th>";
             }
       echo"<th>Order Id</th>
             <th>Total</th>
             <th>Cost</th>
             <th>Shipping</th>
             <th>Address</th>
             <th>Payment Method</th>
       </tr>";

         $order_id = $row["order_id"];
         $user = $row["user"];
         $total = $row["total"];
         $shipping = $row["shipping"];
         $address = $row["address"];
         $payment = $row["payment"];
         $cost=$total-$shipping;
         $purchases = "SELECT order_id, item_id, quantity FROM Purchases WHERE order_id='$order_id' ORDER BY order_id";

       echo"<tr>";
             if($permissions==true){
               echo"<td td style='text-align:center'>
                      <button onclick=window.location.href='deleteOrder.php?id=".$order_id."'>Delete</button>

                      <td>". $user ."  </td>";
             }
             echo"</td><td style='text-align:center'>
             ". $order_id ."
             </td><td style='text-align:right'>
             <b>$". $total ."</b>
             </td><td style='text-align:right'>
             $". $cost ."
             </td><td style='text-align:right'>
             $". $shipping ."
             </td><td>
             ". $address ."
             </td><td>
             ". $payment ."
             </td>
       </td></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>";

       echo"<tr>
             <th>Items Ordered</th>
             <th>Item Name</th>
             <th>Price</th>
             <th>Quantity</th>
       </tr>";

       if($result2 = $mysqli->query($purchases))
       {
         $item_no=1;
         while ($row2 = $result2->fetch_assoc())
           {
             $id=$row2["item_id"];
             $items = "SELECT name, price FROM Items WHERE item_id=$id ORDER BY item_id";
             if($result3 = $mysqli->query($items))
             {
               while ($row3 = $result3->fetch_assoc())
               {
                 $item_name=$row3["name"];
                 $price=$row3["price"];
                 $quantity=$row2["quantity"];

                 echo"<tr><th> ".$item_no." </th>
                 <td>".$item_name."</td>
                 <td style='text-align:right'>".$price."</td>
                 <td style='text-align:right'>".$quantity."</td>
                 </tr>";
                 $item_no=$item_no+1;
               }

             }
             else{
               printf("Error: " . $items . "<br>" . $conn->error);
             }
           }
       }
       else{
         printf("Error: " . $purchases . "<br>" . $conn->error);
       }
       echo"</table><br><br>";


     }
     $result->free(); /* free result set */
   }
   else{
     printf("Error: " . $posts . "<br>" . $conn->error);
   }
   echo"<h3><a href='index.html'>Return Home (Create User)</a></h3>
   <h3><a href='buyItems.php'>Shop School Supplies and Items</a></h3>
   <h3><a href='addingItems.html'>Add Items to the Store</a></h3>
   <h3><a href='selectUserItems.php'>View Your Items and Delete</a></h3>
   <h3><a href='selectUserOrders.php'>View Your Orders and Delete</a></h3>
   <h3><a href='reviews.php'>Reviews</a></h3>";
}
else{
  echo"<h1>The password you entered is incorrect!</h1>
  <h2><a href='javascript:history.back()'>Go Back</a></h2>
  ";
}
/* close connection */
$mysqli->close();
?>
