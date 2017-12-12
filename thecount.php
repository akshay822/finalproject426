<?php
$place_id = $_POST["place_id"];

$conn = new mysqli("localhost", "root", "", "visitamerica");

$countupvotesquery = $conn->query("select count(*) from upvotes where place_id = '".$place_id."'");
$countupvotes = $countupvotesquery->fetch_assoc();

$countdownvotesquery = $conn->query("select count(*) from downvotes where place_id = '".$place_id."'");
$countdownvotes = $countdownvotesquery->fetch_assoc();

$count = $countupvotes["count(*)"] - $countdownvotes["count(*)"];

echo $count;
?>
