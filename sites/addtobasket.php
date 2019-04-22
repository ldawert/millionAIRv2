<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>millionAIR</title>
  </head>
  <body>
    <?php
      session_start();                                                          //use session
      $mysqli = new mysqli("localhost", "root","", "millionAIR");               //connect to database
      if($mysqli->connect_error) {
        echo ("Fehler ". mysqli_connect_error());
        exit();
      }
      $itemID = $_GET['tobasket'];                                              // get the itemID of hte item that the user wants to buy
      $products = $mysqli->query("SELECT * FROM item WHERE itemID={$itemID}");  // get the row of this item from the database
      $product = $products->fetch_array();
      $stock = $product['stock'];                                               // get the current amount in stock of this item
      if (!empty($_SESSION['userID'])) {                                        // check if a user is logged in
        if ($_POST['quantity'] > $stock){                                       // check if quantity is in stock and forward to "low-in-stock-page"
          header("location:/millionAIR/sites/low_in_stock.php?tobasket=$itemID");
          exit;
        }
        if (!empty($_SESSION['basketID'])) {                                    // check if user already has an active basket
          $basketID = $_SESSION['basketID'];                                    // get id of active basket
          $basketquantity = $_POST['quantity'];                                 // get quantity that user wants to purchase
          $positions = $mysqli->query("SELECT * from position WHERE basketID={$basketID}");
          while ($position = $positions->fetch_array()) {                       // get all items that are currently in the basket and iterate over them
            if ($position['itemID'] == $itemID) {                               // if the item is allready in the basket update the quantity for this row
              $newquantity = $position['quantity'] + $basketquantity;
              $positionID = $position['positionID'];
              $insert = $mysqli->query("UPDATE position SET quantity={$newquantity} WHERE positionID={$positionID}");
              $mysqli->query("UPDATE item SET stock = {$stock}-{$basketquantity} WHERE itemID = {$itemID}");  // update stock
              if ($insert == false)
              {
                echo ("Fehler im Warenkorb!");                                  // exit with failure
                exit();
              } else {
                $updated = true;                                                // remember that we are finished with adding to the basket
              }
            }
          }
          if (!$updated)                                                        // if none of the selected item has been in the basket add a new entry for it
          {
            $insert = $mysqli->query("INSERT INTO position (basketID, itemID, quantity) VALUES ({$_SESSION['basketID']}, {$itemID}, {$_POST['quantity']})");
            $mysqli->query("UPDATE item SET stock = {$stock}-{$basketquantity} WHERE itemID = {$itemID}");    // update stock
            if ($insert == false)                                               // check if it worked
            {
              echo ("Fehler im Warenkorb!");                                    // exit with failure
              exit();
            }
          }
          $return = $_GET['return'];                                            // take the user back to where he came from
          header ("location:$return");
        } else {
          $created = $mysqli->query("INSERT INTO basket (userID, paid_for) VALUES ({$_SESSION['userID']}, 0)");     // create a basket for current user in database
          if ($created) {                                                                                           //check if basket was created successfully
            $newBasket = $mysqli->query("SELECT * from basket WHERE userID={$_SESSION['userID']} AND paid_for=0");  // Select new bakset and store its ID in SESSION
            $newBasketrow = $newBasket->fetch_array();
            $_SESSION['basketID'] = $newBasketrow['basketID'];
            $itemID = $_GET['tobasket'];
            $basketquantity = $_POST['quantity'];
            $insert = $mysqli->query("INSERT INTO position (basketID, itemID, quantity) VALUES ({$_SESSION['basketID']}, {$itemID}, {$_POST['quantity']})"); // put item into new basket
            $mysqli->query("UPDATE item SET stock = {$stock}-{$basketquantity} WHERE itemID = {$itemID}");          // update stock
            if (!$insert) {
              echo "Fehler im Warenkorb!";                                      // exit with failure
              exit();
            }
          } else {
            echo "Fehler im Warenkorb!";                                        // exit with failure
            exit();
          }
          $return = $_GET['return'];                                            // take the user back to where he came from
          header ("location:$return");
        }
      } else {
        header ('location:/millionAIR/sites/to_login.php');                     // if user is not loggin in let him know
      }
    ?>
  </body>
</html>
