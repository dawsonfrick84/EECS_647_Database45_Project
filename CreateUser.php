<?php
$mysqli = new mysqli("mysql.eecs.ku.edu", "dawsonfrick84", "aij4eeph", "dawsonfrick84");
$user=$_POST["user"];
$email=$_POST["email"];
$pass=password_hash($_POST["pass"], PASSWORD_DEFAULT);
  echo"
  <html>
      <head>
        <title>User Creation</title>
      </head>
  <body>
  <h1>User Not Created</h1><br>
  <link rel='stylesheet' type='text/css' href='style.css?v={random number/string}'>
  ";
  if ($mysqli->connect_errno) {
      printf("Connect failed: %s<br>", $mysqli->connect_error);
      exit();
  }
  else{
    //printf("Connection to mySQL successful!");
  }

  $query = "SELECT username FROM Users ORDER by username";
  $write=true;

  if ($result = $mysqli->query($query)) {
    //printf("Connection success<br>Passed in username: %s<br>", $user);
      while ($row = $result->fetch_assoc()) {
          if ($row["username"]==$user){
            $write=false;
          }
      }
      if ($write==TRUE){
        printf("Adding user to database...<br>");
        $sql = "INSERT INTO Users (username, email, password, permissions) VALUES ('$user', '$email', '$pass', 0)";

        if ($mysqli->query($sql) === TRUE) {
          printf("User created successfully<br>");
          echo"<script type='text/javascript'>location.href = 'userAddSuccess.html';</script>";
        }
        else {
          printf("Error: " . $sql . "<br>" . $conn->error);
        }
      }
      else {
        printf("User already exists!");
        echo"
        <h2><a href='javascript:history.back()'>Go Back</a></h2>
        ";
      }


      $result->free();
  }



  $mysqli->close();

?>
