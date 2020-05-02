<?php
echo"
<html>

<head>
    <title>Reviews</title>
    <link rel='stylesheet' href='Style1.css'>
</head>
<center><h1>Reviews</h1></center><br>
<body>
View Reviews for this item:
";

        $mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");
        $query = "SELECT item_id, name FROM Items ORDER BY item_id";

        if ($result = $mysqli->query($query))
        {
            echo "<form action='viewReview.php' method='POST'>
                  <select name='item_id'>";
                  while ($row = $result->fetch_assoc())
                  {
                  $item_name = $row["name"];
                  $item_id = $row["item_id"];
                  echo "<option value=".$item_id."> ". $item_name ." </option>";
                  }

                echo"
                <input type='submit' value='SUBMIT'></select></form><br><br>

                <form action='viewReview.php' method='POST'>
                Username:
                <input type='text' id='username' name='username' required><br>
                Password:
                <input type='password' id='username' name='username' required><br>
                <u>Please choose the item you want to review:</u><br>
                <select name='item_id'><br><br>";
                if($result2 = $mysqli->query($query)){
                  while ($row2 = $result2->fetch_assoc())
                  {
                  $item_name = $row2["name"];
                  $item_id = $row["item_id"];
                  echo "<option value=".$item_id."> ". $item_name ." </option>";
                  }
                }


            echo "</select>

            <br>Write Review:<br>
            <input type='text' id='review' name='review' required size='100'><br>
            Rating:
            <input type='number' id='rating' name='rating' min=1 max=5 step=1 required size=3> <br>
            &emsp;&emsp;&emsp;<input type='submit' value='SUBMIT'>
            </form><br>";

        $result->free();
        }
        echo"<form action='viewReview.php' method='POST'>";
        $query2 = "SELECT username FROM Users WHERE permissions=1 ORDER BY username ASC";
        if ($result = $mysqli->query($query2))
        {
            echo "<u>Login as an admin to delete reviews:</u><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;<select name='username'><br><br>";

                while ($row = $result->fetch_assoc())
                {
                $user_name = $row["username"];
                echo "<option> ". $user_name ." </option>";
                }

            echo "</select>
            <input type='hidden' id='permissions' name='permissions' value='true'>
            <br>Password: <input type='password' id='pass' name='pass' required><br>
            &emsp;&emsp;&emsp;&emsp;&emsp;<input type='submit' value='View All Items'>
            </form>";
          }

        $mysqli->close();
    echo"

      </body>

      </html>
    ";
?>
