<!-- Login -->

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>VASA-WIGGIN SPACEDASH Login</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Rubik:400,700'>
  <link rel="stylesheet" href="./login.css">
  <link rel="stylesheet" href="./starstyle.css">

  <script>
    /* inspiration: https://dribbble.com/shots/2292415-Daily-UI-001-Day-001-Sign-Up */

    let form = document.querySelector('form');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      return false;
    });

  </script>
</head>

<body>

  <div id="error-message" style="background: black; font-family: 'Rubik', sans-serif;">
    If this page is blank, there's probably a problem with the database connection. Either the login credentials are wrong, or an expected database, table, column, etc., is not being found.
  </div>

  <?php
    include('/etc/LearningGame/config.php');

    if(!$con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME))
    {
      die("failed to connect!");
    }

    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

      include("functions.php");

        //check if there's already an active session. if so, redirect to menu page.
        if(isset($_SESSION['user_id']))
        {
          $id = $_SESSION['user_id'];
          $query = "select * from LoginCreds where user_id = '$id' limit 1";

          $result = mysqli_query($con,$query);
          if($result && mysqli_num_rows($result) > 0)
          {
            header("Location: menu.php");
            die;
          }
        }

      // check for user input, check username and pw against database
      if($_SERVER['REQUEST_METHOD'] == "POST")
      {
        //something was posted
        $user_name = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
        {

          //read from database
          $query = "select * from LoginCreds where username = '$user_name' limit 1";
          $result = mysqli_query($con, $query);

          if($result)
          {
            if($result && mysqli_num_rows($result) > 0)
            {

              $user_data = mysqli_fetch_assoc($result);

              if($user_data['password'] === $password)
              {
                echo 'correct';
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: ./menu.php");
                die;
              }
            }
          }

          echo "wrong username or password!";
        }else
        {
          echo "missing username and/or password!";
        }
      }
  ?>


  <style>
    #error-message {
      display: none;
    }
  </style>

  <!-- partial:index.partial.html -->
  <div class="login-form">
    <form method="post">
      <h1>Login</h1>
      <div class="content">
        <div class="input-field">
          <input type="username" name ="username" placeholder="username" autocomplete="nope">
        </div>
        <div class="input-field">
          <input type="password" name = "password" placeholder="Password" autocomplete="new-password">
        </div>

      </div>
      <div class="action">

        <button type="submit">Sign in</button>
      </div>
    </form>
  </div>
  <!-- partial -->

  <div id="stars"></div>
  <div id="stars2"></div>
  <div id="stars3"></div>

  <div id="comets">
    <i></i>
    <i></i>
    <i></i>
  </div>

</body>
</html>
