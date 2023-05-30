<?php

require '../dbConnect.php';

if (isset($_GET['id'])) {
  $stmt = $conn->prepare("SELECT * FROM wdv341_recipes WHERE id = ?");
  $stmt->execute(array($_GET['id']));
  $recipe = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
 
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="A recipe website that features recipes and allows you to enter your own recipes.">
    <meta keywords="Recipe, cooking, recipes, meals, Recipe City">
    <link rel="stylesheet" href="style.css">
    <title>Recipe City</title>
    <style>

        #recipeTemplate2Container {
            width: 1024px;
            margin-left: 400px;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        h2 {
            font-family: 'Julius Sans One', sans-serif;
            margin-top: -400px;
            font-size: 50px;
            border-bottom: 4px dotted black;
            padding-bottom: 5px;
            width: 450px;
        }

        p {
            font-family:  'Questrial', sans-serif;
        }

         .recipe-info2 {
            display: flex;
            flex-direction: column;
            position: relative;
         }

         .recipeImage2 {
            margin-left: 900px;
            width: 300px;
            margin-top: 230px;
            height: auto;
            border: 1px solid black;
         }

         .recipeAuthor {
            margin-top: -35px;
         }

         .recipeDesc {
            margin-top: -80px;
            margin-bottom: 50px;
         }

         .recipeTemplate2Ingredients {
            margin-top: 150px;
            font-family:  'Questrial', sans-serif;
            font-weight: 700;
            font-size: 23px;
            margin-bottom: -90px;
         }

         .recipeTemplate2Instructions {
            margin-top: 80px;
            font-family:  'Questrial', sans-serif;
            font-weight: 700;
            font-size: 23px;
            margin-bottom: -70px;
         }

         .hidden {
            display: none;
         }

        
    </style>
    <script>

    document.addEventListener("DOMContentLoaded", function() {
        const toggleIngredientsBtn = document.querySelector('#toggleIngredientsBtn');
        const template2IngredientsList = document.querySelector('#template2IngredientsList');
        toggleIngredientsBtn.addEventListener('click', () => {
            template2IngredientsList.classList.toggle('hidden');
        });

        const toggleInstructionsBtn = document.querySelector('#toggleInstructionsBtn');
        const template2InstructionsList = document.querySelector('#template2InstructionsList');
        toggleInstructionsBtn.addEventListener('click', () => {
            template2InstructionsList.classList.toggle('hidden');
        });
    });
  
    </script>
</head>
<header>
    <nav class="navigation2">
        <div class="logo">
            <a href="index.php"><img src="images/RC-1.png" height="50px" alt="Recipe City Logo"></a>
        </div>
        <div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><img src="images/searchIcon.png" height="30px" class="searchIcon" alt="search icon"></li>
                <li><a href="./administratorRights/login.php"><img src="images/icons8-account-64.png" height="30px" class="accountIcon" alt="account"></a></li>
                <li><a href="inputRecipe.php"><button>Add Recipe</button></a></li>
            </ul>
        </div>
    </nav>
</header>
<body>
    <div id="recipeTemplate2Container">
        <div class="recipe-info2">
            <div class="recipeImage2">
                <img src="data:image/jpeg;base64,<?php echo base64_encode($recipe['recipe_food_image']); ?>" alt="<?php echo $recipe['recipe_title']; ?>">
            </div>
            <h2><?php echo $recipe['recipe_title']; ?></h2>
            <div class="recipeAuthor">Recipe from: <?php echo $recipe['recipe_author']; ?></div>
            <p class="recipeDesc"><?php echo $recipe['recipe_description']; ?></p>
            <div class="uniqueRecipeBox">Category: <?php echo $recipe['recipe_category']; ?></div>
            <div class="uniqueRecipeBox">Cuisine: <?php echo $recipe['recipe_cusine']; ?></div>
            <div class="uniqueRecipeBox">Difficulty: <?php echo $recipe['recipe_difficulty']; ?></div>
            <div class="uniqueRecipeBox">Cook Time: <?php echo $recipe['recipe_cooktime']; ?> <?php echo $recipe['recipe_cooktime_description']; ?></div>
            <div class="uniqueRecipeBox">Yields: <?php echo $recipe['recipe_yields']; ?> <?php echo $recipe['recipe_yields_description']; ?></div>
           <div class="recipeTemplate2Ingredients">Ingredients:</div>
           <button id="toggleIngredientsBtn">Show/Hide Ingredients</button>
            <ul id="template2IngredientsList">
            <?php foreach (explode("\n", $recipe['recipe_ingredients']) as $ingredient): ?>
                <li><?php echo $ingredient; ?></li>
            <?php endforeach; ?>
            </ul>
            <div class="recipeTemplate2Instructions">Instructions:</div>
            <button id="toggleInstructionsBtn">Show/Hide Instructions</button>
            <ol id="template2InstructionsList">
            <?php foreach (explode("\n", $recipe['recipe_instructions']) as $instruction): ?>
                <li><?php echo $instruction; ?></li>
            <?php endforeach; ?>
            </ol>
        </div>
    </div>
    <footer>
        <div class="footer-wrapper">
            <div class="logo-container">
                <div class="logo2">
                    <a href="index.php"><img src="images/RC-1.png" height="75px" alt="Recipe City Logo"></a>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="recipes.php">Recipes</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="inputRecipe.php">Add Recipe</a></li>
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
        <a href="#top" class="backToTop"><img src="images/icons8-up-50.png"></a>
    </footer>
</body>

</html>