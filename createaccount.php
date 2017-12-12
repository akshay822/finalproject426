<?php
  $username = $_POST["username"];
  $password = $_POST["password"];

  $conn = new mysqli("localhost", "root", "", "visitamerica");
  $query = "select * from users where username = '".$username."'";
  $result = $conn->query($query);

  if($result->num_rows == 0){

    $query = "insert into users(username, password) values ('".$username."','".$password."')";
    $result =  $conn->query($query);

    echo "success";
  }
  else{
    echo "username already exists";
  }
 ?>
