<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $db_name = "shoppe1111";

  $connect = mysqli_connect($hostname, $username, $password, $db_name) or die("Cannot connect to database");
?>