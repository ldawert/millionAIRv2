<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document adds the functionality to add products into the basket                                     -->
<!--                                                                                                            -->
<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>web-shop</title>
  </head>
  <body>
    <?php
      session_start(); //use session
      $mysqli = new mysqli("localhost", "root","", "millionAIR");//connect to database
      if($mysqli->connect_error) {
        echo ("Fehler ". mysqli_connect_error());
        exit();
      }
      $ID = $_GET['tobasket'];

      $products = $mysqli->query("SELECT * FROM item WHERE itemID={$ID}");
      $product = $products->fetch_array();
      $stock = $product['stock'];
      if (!empty($_SESSION['userID'])) {
        if ($_POST['quantity'] > $stock){
          header("location:/millionAIR/sites/low_in_stock.php?tobasket=$ID");
          exit;
        }
        if (!empty($_SESSION['basketID'])) {
          $itemID = $_GET['tobasket'];
          $positions = $mysqli->query("SELECT * from position WHERE basketID={$_SESSION['basketID']}");
          while ($position = $positions->fetch_array()) {
            if ($position['itemID'] == $itemID) {
              $newquantity = $position['quantity'] + $_POST['quantity'];
              $positionID = $position['positionID'];
              $insert = $mysqli->query("UPDATE position SET quantity={$newquantity} WHERE positionID={$positionID}");
              if ($insert == false)
              {
                echo ("Fehler im Warenkorb!");
                exit();
              } else {
                $updated = true;
              }
            }
          }
          if (!$updated)
          {
            $insert = $mysqli->query("INSERT INTO position (basketID, itemID, quantity) VALUES ({$_SESSION['basketID']}, {$itemID}, {$_POST['quantity']})");
            if ($insert == false)
            {
              echo ("Fehler im Warenkorb!");
              exit();
            }
          }
          $return = $_GET['return'];
          header ("location:$return");
        } else {
          $created = $mysqli->query("INSERT INTO basket (userID, paid_for) VALUES ({$_SESSION['userID']}, 0)");
          if ($created) {
            $inserted_stuff = $mysqli->query("SELECT * from basket WHERE userID={$_SESSION['userID']} AND paid_for=0");
            $inserted_row = $inserted_stuff->fetch_array();
            $_SESSION['basketID'] = $inserted_row['basketID'];
            $itemID = $_GET['tobasket'];
            $insert = $mysqli->query("INSERT INTO position (basketID, itemID, quantity) VALUES ({$_SESSION['basketID']}, {$itemID}, {$_POST['quantity']})");
            if (!$insert) {
              echo "Fehler im Warenkorb!";
              exit();
            }
          } else {
            echo "Fehler im Warenkorb!";
            exit();
          }
          $return = $_GET['return'];
          header ("location:$return");
        }
      } else {
        header ('location:/millionAIR/sites/to_login.php');
      }
    ?>
  </body>
</html>
