<!DOCTYPE html>
<html lang='en'>
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
        </div>
      </div>
        <div class='spacer_top'></div>
        <div id='content'>
          <div class='login_form'>
            <?php
            $ID = $_GET['tobasket'];
              echo "<form  action='/millionAIR/sites/product.php?product=$ID' method='post'>
                Sorry, we are low in stock right now.<br>
                <input type='submit' class='button' value='back'>
              </form>"
              ?>
          </div>
        </div>
    </body>
</html>
