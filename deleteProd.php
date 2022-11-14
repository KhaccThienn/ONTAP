<?php
  include "connection/connect.php";

  $id = isset($_GET['id']) ? $_GET['id'] : false;

  $sql = "SELECT image FROM product WHERE id = $id";
  $result = $connect -> query($sql);
  $row = $result->fetch_assoc();

  unlink("uploads/".$row['image']);

  $sqlDel = "DELETE FROM product WHERE id = '$id'";
  $query = $connect -> query($sqlDel);

  if($query){
    header('location: list.php');
    exit;
  }
?>