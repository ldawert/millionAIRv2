<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
  session_start();                                                              //start or reconnect to session
?>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      if (!empty($_SESSION['userID']) && !empty($_SESSION['basketID'])) {
        $itemID = $_POST['itemID'];                                             // get itemID from POST form
        $basketID = $_SESSION['basketID'];                                      // get basketID from session
        $oldquantity = $_POST['quant'];

        $mysqli = new mysqli("localhost", "root","", "millionAIR");              //connect to database
        if($mysqli->connect_error) {
          echo ("Fehler ". mysqli_connect_error());
          exit();
        }

        $removed = $mysqli->query("DELETE FROM position WHERE basketID={$basketID} AND itemID={$itemID}"); // delete positions from database
        $mysqli->query("UPDATE item SET stock = stock + {$oldquantity} ");      // add the rmoved items to stock
        if ($removed) {
          $mysqli->query("SELECT * from position WHERE basketID={$basketID}");  // check if basket is empty
          $empty = $mysqli->affected_rows;
          if ($empty == 0 ) {
            $mysqli->query("DELETE FROM basket WHERE basketID={$basketID}");    // remove basket from databse and from session 
            unset($_SESSION['basketID']);
          }
          header ('location:/millionAIR/sites/basket.php');                     // if successfully removed, return to basket
        } else {
          echo "Fehler beim Versuch das Objekt zu löschen!";                    // alert user that removing did not work
          exit();
        }
      } else {
        header ('location:/millionAIR/sites/empty_basket.php');
      }
    ?>

  </body>
</html>
