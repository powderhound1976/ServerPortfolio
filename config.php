<?php


// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'W00392915';
$DATABASE_PASS = 'Christophercs!';
$DATABASE_NAME = 'W00392915';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$currentPage = '';





if (mysqli_connect_errno()) {
  //If there is an error with the connection, stop the script and dislpay the error.
  exit('Failed to connect to MySQL: ' . mysqli_connect_error());
  redirect($currentPage, 'Failed to connect to MySQL: ' . mysqli_connect_error(), 'danger');
}

function pdo_connect_mysql()
{

  // db connection constants
  $DATABASE_HOST = 'localhost';
  $DATABASE_USER = 'W00392915';
  $DATABASE_PASS = 'Christophercs!';
  $DATABASE_NAME = 'W00392915';

  // db connection
  try {
    return new PDO(
      'mysql:host=' . $DATABASE_HOST . ';dbname=' .
      $DATABASE_NAME . ';charset=utf8',
      $DATABASE_USER,
      $DATABASE_PASS
    );
  } catch (PDOException $exctption) {
    die('Failed to connect to the database.');
  }
}



function template_header($title = "Page title")
{
  echo <<<EOT
 <!DOCTYPE html>
  <html>

    <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>$title</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
     <link rel="stylesheet" href="style.css">
     <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
     <script defer src="js/bulma.js"></script>
    </head>

  <body class="bg">
EOT;
}

function template_nav()
{
  if (isset($_SESSION['loggedin'])) {


    echo <<<EOT
  <!-- START NAV -->
    <nav class="navbar is-light">
      <div class="container">
        <div class="navbar-brand">
        
          <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div id="navMenu" class="navbar-menu">
          <div class="navbar-start">
            <!-- navbar link go here -->
          </div>
          <div class="navbar-end">
          <div class="navbar-item">
              <div class="buttons">
                <a href="polls-public.php" class="button">
                  <span class="icon"><i class="fas fa-home"></i></span>
                  <span>Home</span>
                </a>
              </div>
            </div>
          <div class="navbar-item">
              <div class="buttons">
                <a href="profile-admin.php" class="button">
                  <span class="icon"><i class="fas fa-user-cog"></i></span>
                  <span>Admin</span>
                </a>
              </div>
            </div>
            <div class="navbar-item">
              <div class="buttons">
                <a href="logout.php" class="button">
                  <span class="icon"><i class="fas fa-sign-out-alt"></i></span>
                  <span>Logout</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- END NAV -->

    <!-- START MAIN -->
    <section id="hero" class="section">
        
EOT;
  } else {
    echo <<<EOT
  <!-- START NAV -->
    <nav class="navbar is-light">
      <div class="container">
        <div class="navbar-brand">
          
          <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
          </div>
        </div>
        <div id="navMenu" class="navbar-menu">
          <div class="navbar-start">
            <!-- navbar link go here -->
          </div>
          <div class="navbar-end">
            <div class="navbar-item">
              <div class="buttons">
                <a href="login.php" class="button">
                  <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
                  <span>Login</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    <!-- END NAV -->

    <!-- START MAIN -->
    <section id="hero" class="section">
        
EOT;
  }
}

function admin_nav($focus)
{
  if ($focus == 1) {
    echo <<<EOT
    <div class="column darkMenu is-one-quarter">
        <aside class="menu">
            <p class="menu-label"> </p>
            <ul class="menu-list">
                <li>
                    <a class="has-text-white" href="polls-admin.php" >Polls</a>
                </li>
                <li>
                    <a href="profile-admin.php" class="is-active">Profile</a>
                </li>
            </ul>
        </aside>
    </div>
    
  EOT;
  } else {
    echo <<<EOT
    <div class="column darkMenu is-one-quarter">
        <aside class="menu">
            <p class="menu-label">  </p>
            <ul class="menu-list">
                <li>
                    <a href="polls-admin.php" class="is-active">Polls</a>
                </li>
                <li>
                    <a href="profile-admin.php" class="has-text-white">Profile</a>
                </li>
     
            </ul>
        </aside>
    </div>
  EOT;
  }
}
function template_footer()
{
  echo <<<EOT
        </div>
    </section>
    <!-- END MAIN-->

    <!-- START FOOTER -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2021 - All rights reserved.</p>
        </div>
    </footer>
    <!-- END FOOTER -->
    </body>
  </html>
EOT;
}

function success($message)
{
  echo <<<EOT
    <div class="notification is-success">
      <h2 class="title is-2">
  EOT;
  echo $message;
  echo <<<EOT
      </h2>
    </div>
EOT;
}

function danger($message)
{
  echo <<<EOT
    <div class="notification is-danger">
      <h2 class="title is-2">
  EOT;
  echo $message;
  echo <<<EOT
      </h2>
    </div>
EOT;
}

function redirect($location, $msg, $type)
{
  header('Location: ' . $location . '?msg=' . $msg . '&type=' . $type);
}

function message()
{
  if (isset($_GET['type'])) {
    $_GET['type'] == 'success' ? (success($_GET['msg'])) : (danger($_GET['msg']));
  }
}

function admin_check()
{
  if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
  }
}
