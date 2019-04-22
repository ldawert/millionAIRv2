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
  <head>
    <meta charset="utf-8">
    <title>millionAIR</title>
    <!-- This website includes -->
    <!-- External -->
    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <!-- Internal -->
    <link href='/millionAIR/css/general.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='/millionAIR/css/font.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='/millionAIR/css/form.css' media='screen' rel='stylesheet' type='text/css'/>
    <link href='/millionAIR/css/article.css' media='screen' rel='stylesheet' type='text/css'/>
    <!-- End websites includes -->
  </head>
  <body>
    <?php
      session_start();                                                          // pick up session and destroy it. than start a fresh session
      session_destroy();
      session_start();
    ?>
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
    <div id='content'>
      <div class='login_form'>
          <form action="/millionAIR/index.php" method="post">                   <!-- Notify the user that he has logged out -->
            You have successfully logged out.<br>
            <input type="submit" class="button" value="Back to shop">
          </form>
      </div>
    </div>
  </body>
</html>
