<?php
  $username = $_POST["username"];
  $password = $_POST["password"];

  $conn = new mysqli("localhost", "root", "", "visitamerica");

  $query = "select * from users where username = '".$username."'";
  $result = $conn->query($query);
  if($result->num_rows == 0){
    echo "invalid username or password";
  }
  else{
    while($row = $result->fetch_assoc()){
      $dbpassword = $row["password"];
      if($dbpassword == $password){
        echo "success";
      }
      else{
        echo "invalid username or password";
      }
    }
  }
 ?>
