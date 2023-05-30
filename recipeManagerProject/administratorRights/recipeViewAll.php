<?php 
session_start();

if( isset($_SESSION['validUser'] )) {
  
}
else {
  echo "Invalid User"; 
  header('Location: login.php'); 
}

require '../../dbConnect.php';
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT id, recipe_author, recipe_title, recipe_description, recipe_cooktime, recipe_cooktime_description, recipe_yields, recipe_yields_description, recipe_difficulty, recipe_cusine, recipe_category, recipe_ingredients, recipe_instructions FROM wdv341_recipes";  

$stmt = $conn->prepare($sql);

$stmt->execute();

$stmt->setFetchMode(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="adminStyle.css">
    <title>View Recipes - Recipe City</title>
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
<body>
    <h1 class="databaseRecipesPageHeader">Database Recipes</h1>
    <div class="displayRecipes">
        <?php while($row = $stmt -> fetch()): ?> 
            <div class="recipe-panel">
                <h2 class="recipe-title"><?php echo $row['recipe_title'] ?></h2>
                <p class="recipe-description"><?php echo $row['recipe_description'] ?></p>
                <div class="recipe-attributes">
                    <div class="recipe-attribute">Author:</div>
                    <div><?php echo $row['recipe_author'] ?></div>

                    <div class="recipe-attribute">Cooktime:</div>
                    <div><?php echo $row['recipe_cooktime'] ?>
                    <?php echo $row['recipe_cooktime_description'] ?></div>

                    <div class="recipe-attribute">Yields:</div>
                    <div><?php echo $row['recipe_yields'] ?>
                    <?php echo $row['recipe_yields_description'] ?></div>

                    <div class="recipe-attribute">Difficulty:</div>
                    <div><?php echo $row['recipe_difficulty'] ?></div>

                    <div class="recipe-attribute">Cuisine:</div>
                    <div><?php echo $row['recipe_cusine'] ?></div>

                    <div class="recipe-attribute">Category:</div>
                    <div><?php echo $row['recipe_category'] ?></div>

                    <div class="ingredientList">
                        <div class="ingredientLabel">Ingredients:</div>
                        <ul>
                            <?php 
                            $ingredients=explode("\n", $row['recipe_ingredients']);
                            foreach($ingredients as $ingredient){
                                echo "<li>" . $ingredient . "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="instructionList">
                        <div class="instructionLabel">Instructions:</div>
                        <ol>
                            <?php
                            $instructions=explode("\n", $row['recipe_instructions']);
                            foreach($instructions as $instruction) {
                                echo "<li>" . $instruction . "</li>";
                            }
                            ?>
                        </ol>
                    </div>
                    
                    <?php
                    echo "<a href='recipeDelete.php?recipeID=" . $row['id'] . "'><button>Delete</button></a>";
                    echo "<a href='recipeUpdate.php?recipeID=" . $row['id'] . "'><button>Update</button></a>";
                    ?>
                </div>
             </div>
        <?php endwhile; ?>
    </div>
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