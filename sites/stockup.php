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
      $mysqli = new mysqli("localhost", "root","", "millionAIR");               //connect to database
      if($mysqli->connect_error) {
        echo ("Fehler ". mysqli_connect_error());
        exit();
      }
      $itemID = $_POST['itemID'];                                               // get itemID for item to stock up on
      $quantity = $_POST['quantity'];                                           // get new quantity of item
      $updated = $mysqli->query("UPDATE item SET stock={$quantity} WHERE itemID={$itemID}");   // update stock in the database
      if ($updated) {
        header ('location:/millionAIR/sites/admin.php');                        // send user back to admin page
      } else {
        echo "Failure with updating database";                                  // alert user with failure 
        exit();
      }
    ?>
  </body>
</html>
