<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document displays the product page of a selected product                                            -->
<!--                                                                                                            -->
<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!DOCTYPE html>
<html lang='en'>
  <?php
    session_start();
  ?>
  <head>
      <meta charset='utf-8'>
      <meta name='theme-color' content='#171819'>
      <title>Web-Shop</title>
      <link id='favicon' rel='icon' type='' href=''/>
      <!-- This website includes -->
      <!-- External -->
      <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
      <!-- Internal -->
      <link href='/millionAIR/css/general.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='/millionAIR/css/font.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='/millionAIR/css/form.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='/millionAIR/css/article.css' media='screen' rel='stylesheet' type='text/css'/>
      <script type='text/javascript' src='/millionAIR/js/menu.js'></script>
      <!-- End websites includes -->
  </head>
  <body>
    <div id='titleBar'>
      <div id='title_categories'>
        <form class="title-categories" action="/millionAIR/index.php?category=Mods" method="post">
          <input class='button button_title' type="submit" name="Mods" value="Mods">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=Atomizers" method="post">
          <input class='button button_title' type="submit" name="Atomizers" value="Atomizers">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=Juice" method="post">
          <input class='button button_title' type="submit" name="Juice" value="Juice">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=Aroma" method="post">
          <input class='button button_title' type="submit" name="Aroma" value="Aroma">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=DIY" method="post">
          <input class='button button_title' type="submit" name="DIY" value="DIY">
        </form>
        <form class="title-categories" action="/millionAIR/index.php?category=All" method="post">
          <input class='button button_title' type="submit" name="all" value="All">
        </form>
      </div>
      <span class='font_title'><a href='/millionAIR/index.php'>millionAIR</a></span>
      <div id='title_profile'>
          <!-- Logout / Register Template -->
          <?php
            if (empty($_SESSION['userID'])) {
              echo "  <form class='title_profile_align' action='/millionAIR/sites/login.php' method='post'>
                        <input class='button button_title' type='submit' name='login' value='Login'>
                      </form>";
            } else {
              echo "  <form class='title_profile_align' action='/millionAIR/sites/logout.php' method='post'>
                        <input class='button button_title' type='submit' name='logout' value='Logout'>
                      </form>";
            }
          ?>
          <form class="title_profile_align" action="/millionAIR/sites/register.php" method="post">
            <input class='button button_title' type="submit" name="register" value="Register">
          </form>
          <form class="title_profile_align" action="/millionAIR/sites/basket.php" method="post">
            <input class='button button_title' type="submit" name="basket" value="Basket">
          </form>
          <?php
            if (!empty($_SESSION['admin']) && $_SESSION['admin']) {
              echo "  <form class='title_profile_align' action='/millionAIR/sites/admin.php' method='post'>
                        <input class='button button_title' type='submit' name='logout' value='Admin'>
                      </form>";
            }
          ?>
      </div>
    </div>
    <!--<div class='spacer_top'></div>-->
      <div id='content_product'>
        <?php
          $ID = $_GET['product'];
        ?>
        <img class="pic_right" src="/millionAIR/img/<?php echo $ID; ?>.png"></img>
        <div id='content'>
          <div class="login_form">
              <?php
                $mysqli = new mysqli("localhost", "root","", "millionAIR");//connect to database
                if($mysqli->connect_error) {
                  echo ("Fehler ". mysqli_connect_error());
                  exit();
                }
                $products = $mysqli->query("SELECT * FROM item WHERE itemID={$ID}");
                $product = $products->fetch_array();
                $item = $product['item'];
                $price = number_format($product['price'],2);
                $description = $product['description'];
                $maxquant = $product['stock'];
                echo "<div class='product_title'>
                        $item
                      </div>
                      <table id='product_table'>
                        <!--<tr class='product_title'>
                          <th class='product_column'>Poduct</th>
                          <td class='product_column'>$item</td>
                        </tr>-->
                        <tr class='product_price'>
                          <th class='product_column'>Price</th>
                          <td class='product_column'>$price €</td>
                        </tr>
                        <tr class='product_description'>
                          <th class='product_column'>Description</th>
                          <td class='product_column'>$description</td>
                        </tr>
                      </table>
                      <div class='product_bottom'>
                        <form class='button_article_align' action='/millionAIR/sites/addtobasket.php?tobasket=$ID&return=/millionAIR/sites/product.php?product=$ID' method='post'>
                            <span class='text_product_amount'><input type='number' name='quantity' value='1'></span>
                            <input class='button button_product' type='submit' name='submit' value='Buy'>
                        </form>
                      </div>";

          ?>
        </div>
      </div>
    </div>
  </body>
</html>
