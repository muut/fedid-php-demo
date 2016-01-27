<?php
session_start();


function get_avatar($email) {
  $default_avatar = "https://muut.com/home/img/muut.png";
  return "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default_avatar ) . "&s=120";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (!empty($_POST["username"]) && !empty($_POST["email"])) {

  //We’ll add a user here
    $_SESSION['user'] = array(
      "id" => $_POST["username"],
      "displayname" => $_POST["username"],
      "email" => $_POST["email"],
      "avatar" => get_avatar($_POST["email"])
    );

    header( 'Location: ./index.php' ) ;
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>

    <form method="POST">

      <input type="text" name="username" placeholder="username"/><br/>
      <input type="text" name="email" placeholder="email address"/><br/>
      <input type="submit" value="login"/>
      
    </form>

  </body>
</html>