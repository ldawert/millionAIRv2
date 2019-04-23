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
<html lang="en" dir="ltr">
<?php
  session_start();
?>
  <head>
    <meta charset="utf-8">
    <title>millionAIR</title>
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
      <div id='title_menu_button' onclick='toggleMenu()'>
        <i class="fas fa-caret-right button_menu"></i>
      </div>
      <div id='title_categories' class='hide'>
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
                      </form>
                      <form class='title_profile_align' action='/millionAIR/sites/register.php' method='post'>
                        <input class='button button_title' type='submit' name='register' value='Register'>
                      </form>";
            } else {
              echo "  <form class='title_profile_align' action='/millionAIR/sites/logout.php' method='post'>
                        <input class='button button_title' type='submit' name='logout' value='Logout'>
                      </form>
                      <form class='title_profile_align' action='/millionAIR/sites/profile.php' method='post'>
                        <input class='button button_title' type='submit' name='profile' value='Profile'>
                      </form>";
            }
          ?>
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
    <?php
      if (!empty($_SESSION['admin']) && $_SESSION['admin']) {                   //check if user has admin rights
        $mysqli = new mysqli("localhost", "root","", "millionAIR");              //connect to database
  			if($mysqli->connect_error) {
  				echo ("Fehler ". mysqli_connect_error());
  				exit();
  			}
        echo "<div id='content'>";
        $articles = $mysqli->query("SELECT * from item");                       // get all items from databse
        while ($article = $articles->fetch_array()) {                           // iterate over each item and create a field to edit its stock
          $name = $article['item'];
          $itemID = $article['itemID'];
          $stock = $article['stock'];
          echo "<div class='admin-area'><div class='admin-item'>$name" . ":</div>" .
                                "<form class='admin-stock' action='/millionAIR/sites/stockup.php' method='post'>
                                  <input type='hidden' name='itemID' value='$itemID'>
                                  <input class='' type='number' name='quantity' value='$stock'>
                                  <input type='submit' class='button button_title' name='submit' value='update'>
                                </form></div>";
        }
      } else {                                                                  // if user has no admin rights, reject him
        echo "<div class='spacer_top'></div>
                <div id='content'>
                  <div class='login_form'>
                    <form action='/millionAIR/index.php' method='post'>
                        Restricted access!<br>You are not an administrator!<br>
                          <input type='submit' class='button' value='get out!'>
                    </form>
                  </div>
                </div>";
      }
    ?>


  </body>
</html>
