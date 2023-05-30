<?php

session_start();    


$errMsg = ""; 
$validUser = false;

if( isset($_POST['submit'])) {

     $inUserName = $_POST['inUserName'];
     $inPassword = $_POST['inPassword'];
 
     require '../../dbConnect.php'; 
 
     $sql = "SELECT recipe_username, recipe_password FROM wdv_341_recipe_users WHERE recipe_username = :username and recipe_password = :password"; 
 
     $stmt = $conn->prepare($sql); 
 
     $stmt->bindParam(':username', $inUserName);
     $stmt->bindParam(':password', $inPassword); 
 
     $stmt->execute(); 
     
    
     $stmt->setFetchMode(PDO::FETCH_ASSOC);
     $row = $stmt->fetch(); 

 
     if($row) {
      
         $validUser = true;
         $_SESSION['validUser'] = true;  
       
         $_SESSION['username'] = $inUserName; 
     }
     else {
         $errMsg = "Invalid username or password!";
     }
 
 }                    
 else {
     
     if( isset($_SESSION['validUser']))  {
         $validUser = true; 
     }
     
 }

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="adminStyle.css">
    <title>Administrator Login - Recipe City</title>
</head>
<header>
    <nav class="navigation2 loginNav">
        <div class="logo9">
            <a href="index.php"><img src="../images/RC-1.png" height="50px" alt="Recipe City Logo"></a>
        </div>
        <div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../recipes.php">Recipes</a></li>
                <li><a href="../contact.php">Contact</a></li>
                <li><img src="../images/searchIcon.png" height="30px" class="searchIcon" alt="search icon"></li>
                <li><a href="login.php"><img src="../images/icons8-account-64.png" height="30px" class="accountIcon" alt="account"></a></li>
                <li><a href="../inputRecipe.php"><button>Add Recipe</button></a></li>
            </ul>
        </div>
    </nav>
</header>
<body class="loginBody">
<?php
   
    if($validUser) {
        
?>
    <div class="adminPage">
        <h2><strong>Welcome to Recipe Cities Administrator Page.</strong></h2>
        <hr class="adminPageBreak">
        <h3>You are signed in as: <?php echo $_SESSION['username']; ?></h3>

        <ul>Admin options avaliable to you:
            <li><a href="recipeAdd.php">Add new recipe</a></li>
            <li><a href="recipeViewAll.php">Delete or update an recipe</a></li>
            <li><a href="logout.php">Sign off</a></li>
        </ul>
    </div>

<?php                      
        }
        else {
            //display the login form in the folloiwing area
?>

<div class="loginSystemBox">
    <h1 class="recipeLoginHeader">Recipe City Aministrator System</h1>    
    <hr class="loginBreak">
    <div class="loginContainer"> 
        <form method="post" action="login.php" class="recipeLoginForm">
            <h2>Login Form</h2>
            <p>
                <label for="inUserName">Username: </label>
                <input type="text" name="inUserName" id="inUserName" placeholder="Username">
            </p>
            <p>
                <label for="inPassword">Password: </label>
                <input type="password" name="inPassword" id="inPassword">
            </p>
            <span class="errorFormat"><?php echo $errMsg; ?></span>
            <p>
                <input type="submit" id="loginFormBtn" name="submit" value="Login">
                <input type="reset" id="loginResetBtn">
            </p>
        </form>
    </div>
</div>
<?php
    }
?>
    <footer>
        <div class="footer-wrapper loginFooter">
            <div class="logo-container">
                <div class="logo2">
                    <a href="index.php"><img src="../images/RC-1.png" height="75px" alt="Recipe City Logo"></a>
                </div>
            </div>
            <div class="content-container">
                <div class="content">
                    <h3>Socials</h3>
                    <ul class="social-links">
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
                <div class="content">
                    <h3>Navigation</h3>
                    <ul class="navigation-links">
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="login.php">Admin Home page</a>
                        <li><a href="../recipes.php">Recipes</a></li>
                        <li><a href="../contact.php">Contact</a></li>
                        <li><a href="../inputRecipe.php">Add Recipe</a></li>
                    </ul>
                </div>
                <div class="content">
                    <h3>Contact</h3>
                    <div class="contact-info">
                        <p>Email: recipeCity@gmail.com</p>
                        <p>Phone: 515-123-4567</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="copyright">&copy; <?php echo date('Y'); ?> Recipe City</p>
        <a href="#top" class="backToTop"><img src="../images/icons8-up-50.png"></a>
    </footer>
</body>
</html>