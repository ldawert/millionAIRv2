<!---------------------------------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------------------------------->
<!--                                                                                                            -->
<!--   Document created by:  Julian Bründl, Léon Dawert, Bedredin Ouelhazi                                      -->
<!--                                                                                                            -->
<!--   This document implements the function to log in to the website		                                        -->
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
      <title>millionAIR</title>
      <link id='favicon' rel='icon' type='' href=''/>
      <!-- This website includes -->
      <!-- External -->
      <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
      <!-- Internal -->
      <link href='../css/general.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='../css/font.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='../css/form.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='../css/article.css' media='screen' rel='stylesheet' type='text/css'/>
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
    <div class='spacer_top'></div>
    <?php
      $ID = $_GET['product'];                                                   // get information on which product to show
    ?>
    <img class="pic_right" src="/millionAIR/img/<?php echo $ID; ?>.png"></img>
    <div id='content'>
    <div class="login_form">
        <?php
          $mysqli = new mysqli("localhost", "root","", "millionAIR");           //connect to database
    			if($mysqli->connect_error) {
    				echo ("Fehler ". mysqli_connect_error());
    				exit();
    			}
          $products = $mysqli->query("SELECT * FROM item WHERE itemID={$ID}");  // select data for product to show from database
          $product = $products->fetch_array();
          $item = $product['item'];
          $price = number_format($product['price'],2);
          $description = $product['description'];
          $maxquant = $product['stock'];
          echo "<table id='product_table'>
                  <tr>
                    <th class='product_column'>Poduct</th>
                    <td class='product_column'>$item</td>
                  </tr>
                  <tr>
                    <th class='product_column'>Price</th>
                    <td class='product_column'>$price €</td>
                  </tr>
                  <tr>
                    <th class='product_column'>Description</th>
                    <td class='product_column'>$description</td>
                  </tr>
                </table>
                <form class='button_article_align' action='/millionAIR/sites/addtobasket.php?tobasket=$ID&return=/millionAIR/sites/product.php?product=$ID' method='post'>
                    <span class='article_price'><input type='number' name='quantity' placeholder='In stock: $maxquant'></span>
                    <input class='button button_article' type='submit' name='submit' value='Buy'>
                </form>";                                                       // echo product information. Let user select quantity to buy.

        ?>
    </div>
    </div>
  </body>
</html>
