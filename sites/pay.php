<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
  session_start();
?>
  <head>
    <meta charset="utf-8">
    <title>millionAIR</title>
  </head>
  <body>
    <?php
    if (!empty($_SESSION['userID']) && !empty($_SESSION['basketID']))           // check if user is logged in and has an active basket
    {
      $mysqli = new mysqli("localhost", "root","", "millionAIR");               //connect to database
      if($mysqli->connect_error) {
        echo ("Fehler ". mysqli_connect_error());
        exit();
      }
      $sum = number_format($_POST['sum'],2);                                    // get total price for the bakset
      $userID = $_SESSION['userID'];                                            // get userID and basketID
      $basketID = $_SESSION['basketID'];
      $userDB = $mysqli->query("SELECT * FROM users WHERE userID={$userID}");   // get userdata from database
      $user = $userDB->fetch_array();
      $from = "shop@millionAIR.com";                                            // set parameters for e-mailing
      $to = $user['username'];
      $subject = "Your order #$basketID at millionAIR";
      $message = "Your order has been placed and was paid successfully!
You will be charged with $sum € for your order #$basketID

Vape on!
Your millionAIR-Team";
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);                                    // send a mail to the user and verify his purchase
      $mysqli->query("UPDATE basket SET paid_for=1 WHERE basketID={$basketID}");// update that the basket has been paid for
      unset ($_SESSION['basketID']);                                            // remove basket from session
      header ('location:/millionAIR/sites/paid.php');                           // forward user to site paid.php
    } else {
      header ('location:/millionAIR/sites/to_login.php');                       // prompt the user to log in
    }
    ?>

  </body>
</html>
