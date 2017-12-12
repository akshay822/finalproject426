<?php
  $username = $_POST["username"];
  $place_id = $_POST["place_id"];
  $comment = $_POST["comment"];

  $conn = new mysqli("localhost", "root", "", "visitamerica");
  $conn->query("insert into comments values ('', '".$username."', '".$place_id."', '".$comment."')");

  header("Location: place.php?id=" . $place_id);
 ?>
