<?php
  $hostname = "localhost";
  $username = "u893061261_abcdAshok";
  $password = "King@#5178";
  $dbname = "u893061261_abcdAshok";

   

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
