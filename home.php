<?php
  session_start();
  if(isset($_GET["username"])) $_SESSION["username"] = $_GET["username"];
 ?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="home.css">

    <title>
      Home Page
    </title>
  </head>
  <body>
    <div id = "container">
      <div id = "menu">
        <a href = "home.php" id = "logo">Visit America</a>
        <a href = "logout.php">(<?php echo $_SESSION["username"]; ?>) Logout</a>
        <a href = "#">Sort By Downvotes</a>
        <a href = "#">Sort by Upvotes</a>
      </div>
      <div id = "tiles">
        <?php
          $conn = new mysqli("localhost", "root", "", "visitamerica");
          $result = $conn->query("select * from places");
          while($row = $result->fetch_assoc()){

            $id = $row["id"];
            $name = $row["name"];
            $image_url = $row["image"];
            $description = $row["description"];
            echo '
              <div class = "tile">
                <div class = "tile_image">
                  <img src = "'.$image_url.'" width = "100%" >
                </div>
                <div class = "tile_name">
                  <a href = "place.php?id='.$id.'">'.$name.'</a>
                </div>
                <div class = "tile_description">
                  '.$description.'
                </div>
              </div>
            ';
          }
         ?>
      </div>

    </div>
  </body>
</html>
