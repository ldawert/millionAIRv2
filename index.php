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
      <link href='/millionAIR/css/general.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='/millionAIR/css/font.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='/millionAIR/css/form.css' media='screen' rel='stylesheet' type='text/css'/>
      <link href='/millionAIR/css/article.css' media='screen' rel='stylesheet' type='text/css'/>
      <!-- End websites includes -->
  </head>
  <body>
    <!-- Titlebar -->
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
              // if User is not logged in show login button
              echo "  <form class='title_profile_align' action='/millionAIR/sites/login.php' method='post'>
                        <input class='button button_title' type='submit' name='login' value='Login'>
                      </form>
                      <form class='title_profile_align' action='/millionAIR/sites/register.php' method='post'>
                        <input class='button button_title' type='submit' name='register' value='Register'>
                      </form>";
            } else {
              // if User is logged in show logout button
              echo "  <form class='title_profile_align' action='/millionAIR/sites/logout.php' method='post'>
                        <input class='button button_title' type='submit' name='logout' value='Logout'>
                      </form>
                      <form class='title_profile_align' action='/millionAIR/sites/profile.php' method='post'>
                        <input class='button button_title' type='submit' name='profile' value='Profile'>
                      </form>";
            }
          ?>
          <form class='title_profile_align' action='/millionAIR/sites/basket.php' method='post'>
            <input class='button button_title' type='submit' name='basket' value='Basket'>
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
    <!-- End Titlebar -->
    <!-- Searchbar -->
    <header>
      <div id='searchSpace'>
        <label id='searchBoxPreText' class='font_bold'>
          <span class='font_pre01'> ~ </span>
          <span class='font_pre02'> ❯ </span>
          <span class='font_pre03'> search </span>
        </label>
        <form id='searchBox' class='font_bold' method='post' action='/millionAIR/index.php?category=search'>
          <input id='searchInput' type='text' name='searching' placeholder='' autocomplete='off' autofocus>
        </form>
      </div>
    </header>
    <!-- End Searchbar -->
    <div id='content'>
    <div class='preview'>
      <?php
        $mysqli = new mysqli("localhost", "root","", "millionAIR");//connect to database
  			if($mysqli->connect_error) {
  				echo ("Fehler ". mysqli_connect_error());
  				exit();
  			}
        if (!empty($_GET['category']))
        {
          $category = $_GET['category'];
          switch ($category) {
            case 'Mods':
              $articles = $mysqli->query("SELECT * FROM item WHERE categoryID=3");
              break;
            case 'Atomizers':
              $articles = $mysqli->query("SELECT * FROM item WHERE categoryID=4");
              break;
            case 'Juice':
              $articles = $mysqli->query("SELECT * FROM item WHERE categoryID=1");
              break;
            case 'Aroma':
              $articles = $mysqli->query("SELECT * FROM item WHERE categoryID=2");
              break;
            case 'DIY':
              $articles = $mysqli->query("SELECT * FROM item WHERE categoryID=5");
              break;
            case 'search':
              if (!empty($_POST['searching'])) {
                $search = "'%" . $_POST['searching'] . "%'";
                $articles = $mysqli->query("SELECT * FROM item i JOIN category c ON i.categoryID = c.categoryID
                                            WHERE i.item LIKE {$search} OR i.description LIKE {$search} OR c.category LIKE {$search}");
              } else {
                $articles = $mysqli->query("SELECT * FROM item");
              }
              break;
            case 'All':
              $articles = $mysqli->query("SELECT * FROM item");
              break;
            default:
              $articles = $mysqli->query("SELECT * FROM item");
              break;
          }
        } else {
          $articles = $mysqli->query("SELECT * FROM item");
          $category = 'All';
        }
        while ($article = $articles->fetch_array()) {
          $pic = $article['itemID'] . ".png";
          $name = $article['item'];
          $description = $article['description'];
          $price = number_format($article['price'],2);
          $ID = $article['itemID'];
          echo "    <div class='article'>
                    <div class='article_tile'>
                        <a class='article_tile' href='/millionAIR/sites/product.php?product=$ID'>$name</a>
                    </div>
                    <div class='article_content'>
                      <a href='/millionAIR/sites/product.php?product=$ID'>
                      <img src='/millionAIR/img/$pic' class='article_image'>
                      </a>
                      <div class='article_short_description'>
                        <!-- Add Short Description here! -->
                        $description
                      </div>
                    </div>
                    <div class='article_bottom'>
                      <span class='article_price'>$price €</span>
                      <form class='button_article_align' action='/millionAIR/sites/addtobasket.php?tobasket=$ID&return=/millionAIR/index.php?category=$category' method='post'>
                          <input class='button button_article' type='submit' name='$ID' value='Buy'>
                          <input type='hidden' name='quantity' value='1'>
                      </form>
                    </div>
                  </div>";
        }
      ?>
      </div>
    </div>
  </body>
</html>
