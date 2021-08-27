<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: sign in.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="css/account.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        .welcome{ margin-top: 10%; color: darkgray; background: rgba(0, 0, 0, 0.6);}
    </style>
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
            <li class="current">
                <?php
                        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
                            echo '<a href="sign in.php">Sign in</a>';
                        }
                        else
                            {
                                echo '<a href="#">', htmlspecialchars($_SESSION["username"]),'</a>
                                <div class="menu"> 
                                    <ul> 
                                        <li> <a  href="profile.php">Profile</a> </li> 
                                        <li> <a  href="signout.php">Sign out</a> </li> 
                                    </ul> 
                                </div>';
                            } 
                ?>        
            </li>
            <li><a href="about us.php">ABOUT</a></li>
     
    
        </ul>
    </div>
    <div class="welcome">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>

    <div style="color:white; background:black; opacity:0.7;">
        <h1>Sorry, I've accidentally deleted the orders page code but you can make sure that order has been placed by checking the orders table in database.</h1>
        <h1>Now I don't want to put an effort to create this page again for no reason...</h1>
    </div>

</body>
</html>