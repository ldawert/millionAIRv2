<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document adds the functionality to stock up the products in the database                            -->
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
      $mysqli = new mysqli("localhost", "root","", "millionAIR");//connect to database
      if($mysqli->connect_error) {
        echo ("Fehler ". mysqli_connect_error());
        exit();
      }
      $itemID = $_POST['itemID'];
      $quantity = $_POST['quantity'];
      $updated = $mysqli->query("UPDATE item SET stock={$quantity} WHERE itemID={$itemID}");
      if ($updated) {
        header ('location:/millionAIR/sites/admin.php');
      } else {
        echo "Failure with updating database";
        exit();
      }
    ?>
  </body>
</html>
