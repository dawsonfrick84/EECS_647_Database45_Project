<?php
//$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "oathu4Ai", "dawsonfrick84");
$user=$_POST["user"];
$pass=password_hash($_POST["pass"], PASSWORD_DEFAULT);
  echo"
  <html>
      <head>
        <title>User Created</title>
      </head>
  <body>
  <h1>User Created</h1><br>
  <link rel='stylesheet' type='text/css' href='style.css'>
  Hello $user!<br>
  Your password is $pass.<br>
  ^If that is not what you entered, the hash worked!
  ";
  // if ($mysqli->connect_errno) {
  //     printf("Connect failed: %s<br>", $mysqli->connect_error);
  //     exit();
  // }
  //
  // $query = "SELECT user_id FROM Users ORDER by user_id";
  // $write=true;
  //
  // if ($result = $mysqli->query($query)) {
  //   printf("Connection success<br>Passed in user id: %s<br>", $user);
  //     while ($row = $result->fetch_assoc()) {
  //         if ($row["user_id"]==$user){
  //           $write=false;
  //         }
  //     }
  //     if ($write==TRUE){
  //       printf("Adding user to database...<br>");
  //       $sql = "INSERT INTO Users (user_id) VALUES ('$user')";
  //
  //       if ($mysqli->query($sql) === TRUE) {
  //         printf("User created successfully<br>");
  //       }
  //       else {
  //         printf("Error: " . $sql . "<br>" . $conn->error);
  //       }
  //     }
  //     else {
  //       printf("User already exists!");
  //     }
  //
  //
  //     $result->free();
  // }
  //
  //
  //
  // $mysqli->close();
  // }

?>
