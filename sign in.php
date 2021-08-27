<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: home page.php");
  exit;
}
require_once "config.php";
$username = $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty($username_err) && empty($password_err)){
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            header("location: profile.php");
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Adidas Sign in</title>
    <link rel="stylesheet" href="css/sign in.css">
      
      
  </head>
  <body>
    <div class="header">
      <ul>
          <a href="home page.php"><img src="images/adidas-logo1.png" alt="" class="logo"></a>
          <li><a href="#">Category</a>

              <div class="menu">
                  <ul>
                      <li><a href="predator.php">Predator</a></li>
                      <li><a href="nemeziz.php">Nemeziz</a></li>
                      <li><a href="adizero.php">Adizero</a></li>
                      <li><a href="x ghosted.php">X Ghosted</a></li>
                      <li><a href="copa.php">Copa</a></li>
                  </ul>
              </div>

          </li>
          <li class="current"><a href="sign in.php">Sign in</a> </li>
          <li><a href="about us.php">ABOUT</a></li>
   
  
      </ul>
  </div>
<div class="box">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="signin">
    <h2>Sign in to Adidas</h2>
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div><br><br><br><br>
    <h2>Don't have an account?</h2><br>
    <a href="sign up.php">Sign up now</a>
  </form>
  

</div>

      <script src="js/Sign in.js"></script>

  </body>
</html>
