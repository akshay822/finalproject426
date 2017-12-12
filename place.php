<?php
  session_start();
 ?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="place.css">
    <script src = "js/jquery.js"></script>

    <title>
      Home Page
    </title>

  </head>
  <body>
    <div id = "container">
      <div id = "error_message">

      </div>
      <div id = "menu">
        <a href = "home.php" id = "logo">Visit America</a>
        <a href = "logout.php">(<?php echo $_SESSION["username"]; ?>) Logout</a>
        <!-- <a href = "#">Sort By Upvotes</a>
        <a href = "#">Sort by Downvotes</a> -->
      </div>
      <div id = "place">
        <?php
          $id = $_GET["id"];
          $conn = new mysqli("localhost", "root", "", "visitamerica");
          $result = $conn->query("select * from places where id = '".$id."'");
          while($row = $result->fetch_assoc()){
            $name = $row["name"];
            $image_url = $row["image"];
            $description = $row["description"];

            echo '
              <div id = "place_image">
                <img src = "'.$image_url.'" width = "100%"/>
              </div>
              <div id = "place_info">
                '.$name.' | <button id = "upvote">Upvote</button> | <button id = "downvote">Downvote</button> | Votes Total : <span id ="count"></span>
              </div>
              <div id = "place_description">
                '.$description.'
              </div>
            ';
          }
         ?>
         <form method = "post" action = "comment.php">
           <textarea name = "comment">Comment here...</textarea><br/>
           <input type = "hidden" name = "place_id" value = "<?php echo $_GET['id']; ?>"/>
           <input type = "hidden" name = "username" value = "<?php echo $_SESSION['username']; ?>"/>
           <input type = "submit" name = "Comment"/>
         </form>

         <div id = "comments">
           <?php
            $result = $conn->query("select * from comments where place_id = $id order by id desc");

            while($row = $result->fetch_assoc()){
              $comment_username = $row["username"];
              $comment_comment = $row["comment"];
              echo '
                <b>'.$comment_username.'</b><br/>
                '.$comment_comment.'<hr/>
              ';
            }
            ?>
         </div>

         <script>
             $(document).ready(function(){

               place_id = <?php echo $_GET['id']; ?>;
               $.ajax({
                 type : "POST",
                 url : "thecount.php",
                 data: {"place_id" : place_id},
                 success: function(data){
                   $("#count").html(data);
                 }
               });


               $("#upvote").on("click", function(){
                place_id = <?php echo $_GET['id']; ?>;
                username =  "<?php echo $_SESSION['username']; ?>";

                     $.ajax({
                       type: "POST",
                       url: "upvote.php",
                       data: {"place_id": place_id, "username": username},
                       success: function(data){
                           $("#count").html(data);

                       }
                     });

                 return false;
               });

               $("#downvote").on("click", function(){
                place_id = <?php echo $_GET['id']; ?>;
                username =  "<?php echo $_SESSION['username']; ?>";

                     $.ajax({
                       type: "POST",
                       url: "downvote.php",
                       data: {"place_id": place_id, "username": username},
                       success: function(data){
                           $("#count").html(data);

                       }
                     });

                 return false;
               });

            });
         </script>

      </div>
    </div>
  </body>
</html>
