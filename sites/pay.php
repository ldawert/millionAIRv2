<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document implements the payment process of the chosen products                                      -->
<!--                                                                                                            -->
<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
  session_start();
?>
  <head>
    <meta charset="utf-8">
    <title>web-shop</title>
  </head>
  <body>
    <?php
    if (!empty($_SESSION['userID']) && !empty($_SESSION['basketID']))
    {
      $mysqli = new mysqli("localhost", "root","", "millionAIR");//connect to database
      if($mysqli->connect_error) {
        echo ("Fehler ". mysqli_connect_error());
        exit();
      }
      $sum = $_POST['sum'];
      $userID = $_SESSION['userID'];
      $basketID = $_SESSION['basketID'];
      $userDB = $mysqli->query("SELECT * FROM users WHERE userID={$userID}");
      $user = $userDB->fetch_array();
      $from = "shop@millionAIR.com";
      $to = $user['username'];
      $subject = "Your order #$basketID at millionAIR";
      $message = "Your order has been placed and was paid successfully!
You will be charged with $sum € for your order $basketID

Vape on!
Your millionAIR-Team";
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);
      $mysqli->query("UPDATE basket SET paid_for=1 WHERE basketID={$basketID}");
      unset ($_SESSION['basketID']);
      header ('location:/millionAIR/sites/paid.php');
    } else {
      header ('location:/millionAIR/sites/to_login.php');
    }
    ?>

  </body>
</html>
