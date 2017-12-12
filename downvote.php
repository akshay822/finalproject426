<?php
  $place_id = $_POST["place_id"];
  $username = $_POST["username"];


  $conn = new mysqli("localhost", "root", "", "visitamerica");
  $query = "select * from downvotes where username = '".$username."' and place_id = '".$place_id."'";
  $result = $conn->query($query);



  if($result->num_rows == 0){
    $query = "insert into downvotes(username, place_id) values ('".$username."', '".$place_id."')";
    $result = $conn->query($query);

    $query2 = "delete from upvotes where username = '".$username."' and place_id = '".$place_id."'";
    $result2 = $conn->query($query2);

    $countupvotesquery = $conn->query("select count(*) from upvotes where place_id = '".$place_id."'");
    $countupvotes = $countupvotesquery->fetch_assoc();

    $countdownvotesquery = $conn->query("select count(*) from downvotes where place_id = '".$place_id."'");
    $countdownvotes = $countdownvotesquery->fetch_assoc();

    $count = $countupvotes["count(*)"] - $countdownvotes["count(*)"];

    echo $count;
  }
  else{
    $countupvotesquery = $conn->query("select count(*) from upvotes where place_id = '".$place_id."'");
    $countupvotes = $countupvotesquery->fetch_assoc();

    $countdownvotesquery = $conn->query("select count(*) from downvotes where place_id = '".$place_id."'");
    $countdownvotes = $countdownvotesquery->fetch_assoc();

    $count = $countupvotes["count(*)"] - $countdownvotes["count(*)"];

    echo $count;
  }

?>
