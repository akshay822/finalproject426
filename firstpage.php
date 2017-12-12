<html>
  <head>
    <link rel="stylesheet" type="text/css" href="firstpage.css">

    <title>
      Visit America
    </title>

    <script src = "js/jquery.js"></script>
  </head>
  <body>
    <div id = "container">
      <div id = "error_message">

      </div>
      <div id = "login_container">
        <h2>Visit America</h2>
        Username <br/>
        <input type = "text" id = "username"/><br/>
        Password <br/>
        <input type = "password" id = "password"/><br/><br/>
        <button id = "login">Login</button>
        <button id = "createaccount">Create Account</button><br/>
        <!-- <a href = "register.php">Don't have an account? Register here!</a><br/> -->
      </div>
    </div>

    <!--jquery stuff-->
    <script>
      $(document).ready(function(){
        $("#login").on("click", function(){
          username = $("#username").val();
          password = $("#password").val();

          if(username.length >= 5){
            if(password.length >= 5){
              $.ajax({
                type: "POST",
                url: "login.php",
                data: {"username": username, "password": password},
                success: function(data){
                  if(data == "success"){
                    window.location.replace("home.php?username=" + username);
                  }
                  else{
                    $("#error_message").text(data);
                  }
                }
              });
            }
            else $("#error_message").text("invalid password");
          }
          else $("#error_message").text("invalid username");
          return false;
        });

        $("#createaccount").on("click", function(){
          username = $("#username").val();
          password = $("#password").val();

          if(username.length >= 5){
            if(password.length >= 5){
              $.ajax({
                type : "POST",
                url: "createaccount.php",
                data: {"username": username, "password": password},
                success: function(data){
                  if(data == "success"){
                    window.location.replace("home.php?username=" + username);
                  }
                  else{
                    $("#error_message").text(data);
                  }
                }
              });
            }
            else $("#error_message").text("passwords must be 5 characters or greater");
          }
          else $("#error_message").text("username must be 5 characters or greater");
          return false;
        });

      });
    </script>
  </body>
</html>
