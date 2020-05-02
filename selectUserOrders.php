
<?php
echo"
<html>

<head>
    <title>Reviews</title>
    <link rel='stylesheet' href='Style1.css?v={random number/string}'>
</head>
<center><h1>View and Delete Orders</h1></center><br>
<body>
    <form action='viewOrders.php' method='POST'>
";
        $mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");
        $query = "SELECT username FROM Users ORDER BY username ASC";

        if ($result = $mysqli->query($query))
        {
            echo "<u>Please choose the user whose orders you want to view:</u><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;<select name='username'><br><br>";

                while ($row = $result->fetch_assoc())
                {
                $user_name = $row["username"];
                echo "<option> ". $user_name ." </option>";
                }

            echo "</select>
            <br>Password:
            <input type='password' id='pass' name='pass' required><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;<input type='submit' value='View orders'>
            </form><br>";

        $result->free();
        }
        echo"<form action='viewOrders.php' method='POST'>";
        $query2 = "SELECT username FROM Users WHERE permissions=1 ORDER BY username ASC";
        if ($result = $mysqli->query($query2))
        {
            echo "<u>Login as an admin to view all orders:</u><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;<select name='username'><br><br>";

                while ($row = $result->fetch_assoc())
                {
                $user_name = $row["username"];
                echo "<option> ". $user_name ." </option>";
                }

            echo "</select>
            <input type='hidden' id='permissions' name='permissions' value='true'>
            <br>Password: <input type='password' id='pass' name='pass' required><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;<input type='submit' value='View All orders'>
            </form>";
          }

        $mysqli->close();
    echo"
    <br>
      <h3><a href='index.html'>Return Home (Create User)</a></h3>
      <h3><a href='buyItems.php'>Shop School Supplies and Items</a></h3>
      <h3><a href='addingItems.html'>Add Items to the Store</a></h3>
      <h3><a href='selectUserItems.php'>View Your Items and Delete</a></h3>
      <h3><a href='selectUserOrders.php'>View Your Orders and Delete</a></h3>
      <h3><a href='reviews.php'>Reviews</a></h3>
      </body>

      </html>
    ";
?>
