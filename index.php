<?php
session_start();

//the api key from your forum settings
$public_key = "apikey";
// the secret key from your forum settings
$private_key = "testapisecretkey";

//saving the user object from the session into
//a new “auth” object
$auth_object = array( "user" => $_SESSION['user'] );

//Taking the auth object, converting to json then
//base64 encoding the json data
$message  = base64_encode(json_encode($auth_object));

//save the current server timestamp
$timestamp  = time();

//we’re creating a signature using the message, timestamp,
//and secret key
$signature  = sha1($private_key . ' ' . $message . ' ' . $timestamp);


?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width">
  </head>
  <body>

<?php if ($_SESSION['user']) { ?>
  <a href="./logout.php"> logout </a>
<?php } else { ?>
  <a href="./login.php"> login </a>
<?php } ?>
  | <a href="./contact.php">Messaging</a>
<br/><br/>

<hr>


<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<link rel="stylesheet" href="//cdn.muut.com/1/moot.css">
<script src="//cdn.muut.com/1/moot.min.js"></script>

<a id="my-community" href="https://muut.com/i/playground">Community</a>

<script>
$('#my-community').muut({
  login_url: "./login.php",
  api: {
    key: '<?php echo $public_key ?>',
    message: '<?php echo $message ?>',
    signature: '<?php echo $signature ?>',
    timestamp: <?php echo $timestamp ?>
  }
})
</script>

</body>
</html>