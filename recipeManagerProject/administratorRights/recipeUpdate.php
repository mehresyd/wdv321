<?php
session_start();
if( isset($_SESSION['validUser'] )) {
  
}
else {
  header('Location: login.php'); 
}

if(isset($_POST['submit'])) {

    $recipeID = $_GET['recipeID'];
    $recipe_author = $_POST['recipe_author'];
    $recipe_author_email = $_POST['recipe_author_email'];
    $recipe_title = $_POST['recipe_title'];
    $recipe_description = $_POST['recipe_description'];
    $recipe_cooktime = $_POST['recipe_cooktime'];
    $recipe_cooktime_description = $_POST['recipe_cooktime_description'];
    $recipe_yields = $_POST['recipe_yields'];
    $recipe_yields_description = $_POST['recipe_yields_description'];
    $recipe_difficulty = $_POST['recipe_difficulty'];
    $recipe_cusine = $_POST['recipe_cusine'];
    $recipe_category = $_POST['recipe_category'];
    $recipe_ingredients = implode("\n", $_POST['recipe_ingredients']);
    $recipe_instructions = implode("\n", $_POST['recipe_instructions']);

    require '../../dbConnect1.php'; 
    $sql = "UPDATE wdv341_recipes SET recipe_author=:recipe_author, recipe_author_email=:recipe_author_email, recipe_title=:recipe_title, recipe_description=:recipe_description, recipe_cooktime=:recipe_cooktime, recipe_cooktime_description=:recipe_cooktime_description, recipe_yields=:recipe_yields, recipe_yields_description=:recipe_yields_description, 
    recipe_difficulty=:recipe_difficulty, recipe_cusine=:recipe_cusine, recipe_category=:recipe_category, recipe_ingredients=:recipe_ingredients, recipe_instructions=:recipe_instructions WHERE id=:recipeID";


    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':recipe_author', $recipe_author);
    $stmt->bindParam(':recipe_author_email', $recipe_author_email);
    $stmt->bindParam(':recipe_title', $recipe_title);
    $stmt->bindParam(':recipe_description', $recipe_description);
    $stmt->bindParam(':recipe_cooktime', $recipe_cooktime);
    $stmt->bindParam(':recipe_cooktime_description', $recipe_cooktime_description);
    $stmt->bindParam(':recipe_yields', $recipe_yields);
    $stmt->bindParam(':recipe_yields_description', $recipe_yields_description);
    $stmt->bindParam(':recipe_difficulty', $recipe_difficulty);
    $stmt->bindParam(':recipe_cusine', $recipe_cusine);
    $stmt->bindParam(':recipe_category', $recipe_category);
    $stmt->bindParam(':recipe_ingredients', $recipe_ingredients);
    $stmt->bindParam(':recipe_instructions', $recipe_instructions);
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->execute();

    header('Location: recipeViewAll.php');  
}
else {
    $recipeID = $_GET['recipeID'];
   
    require '../../dbConnect.php';
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT id, recipe_author, recipe_author_email, recipe_title, recipe_description, recipe_cooktime, recipe_cooktime_description, recipe_yields, recipe_yields_description, recipe_difficulty, recipe_cusine, recipe_category, recipe_ingredients, recipe_instructions FROM wdv341_recipes WHERE id=:recipeID";  
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $row = $stmt->fetch(); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="adminStyle.css">
    <title>Update Recipe - Recipe City</title>
    <style>
        .input-group {
            display: flex;
            align-items: center;
        }

        .input-container {
            position: relative;
        }

        .close-btn {
            position: absolute;
            right: -18px;
            top: 40%;
            transform: translateY(-50%);
            cursor: pointer;
            color: red;
            font-size: 25px;

        }

        .recipeAddFormH3 {
            margin-right: 250px;
        }
    </style>


    <script>
        function addIngredientInput() {
            let ingredientInputs = document.querySelector("#ingredientInputs");
            let newInputGroup = document.createElement("div");
            newInputGroup.setAttribute("class", "input-group");

            // Create the input element
            let newInput = document.createElement("div");
            newInput.setAttribute("class", "input-container");

            let newTextarea = document.createElement("textarea");
            newTextarea.setAttribute("class", "recipeCardFormTextarea");
            newTextarea.setAttribute("name", "recipe_ingredients[]");
            newTextarea.setAttribute("rows", "2");
            newTextarea.style.width = "400px";
            newTextarea.style.height = "23px";
            newInput.appendChild(newTextarea);

            // Create the X icon if it's not the first input box
            let inputGroups = document.querySelectorAll("#ingredientInputs .input-group");
            let index = inputGroups.length;
            if (ingredientInputs.children.length > 0) {
                let removeIcon = document.createElement("span");
                removeIcon.innerHTML = "&times;";
                removeIcon.className = "close-btn";
                removeIcon.onclick = function () {
                    newInputGroup.remove();
                };
                newInput.appendChild(removeIcon);
            }

            // Add the input element to the new input group
            newInputGroup.appendChild(newInput);

            // Add the new input group to the instructionInputs element
            ingredientInputs.appendChild(newInputGroup);
        }



        function addInstructionInput() {
            let instructionInputs = document.querySelector("#instructionInputs");
            let newInputGroup = document.createElement("div");
            newInputGroup.setAttribute("class", "input-group");

            // Create the input element
            let newInput = document.createElement("div");
            newInput.setAttribute("class", "input-container");

            let newTextarea = document.createElement("textarea");
            newTextarea.setAttribute("class", "recipeCardFormTextarea");
            newTextarea.setAttribute("name", "recipe_instructions[]");
            newTextarea.setAttribute("rows", "5");
            newTextarea.style.width = "400px";
            newTextarea.style.height = "23px";
            newInput.appendChild(newTextarea);

            // Create the X icon if it's not the first input box
            let inputGroups = document.querySelectorAll("#instructionInputs .input-group");
            let index = inputGroups.length;
            if (instructionInputs.children.length > 0) {
                let removeIcon = document.createElement("span");
                removeIcon.innerHTML = "&times;";
                removeIcon.className = "close-btn";
                removeIcon.onclick = function () {
                    newInputGroup.remove();
                };
                newInput.appendChild(removeIcon);
            }

            // Add the input element to the new input group
            newInputGroup.appendChild(newInput);

            // Add the new input group to the instructionInputs element
            instructionInputs.appendChild(newInputGroup);
        }
    </script>
</head>
<header>
    <nav class="navigation2">
        <div class="logo9">
            <a href="index.php"><img src="../images/RC-1.png" height="50px" alt="Recipe City Logo"></a>
        </div>
        <div>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../recipes.php">Recipes</a></li>
                <li><a href="../contact.php">Contact</a></li>
                <li><img src="../images/searchIcon.png" height="30px" class="searchIcon" alt="search icon"></li>
                <li><a href="login.php"><img src="../images/icons8-account-64.png" height="30px" class="accountIcon"
                            alt="account"></a></li>
                <li><a href="../inputRecipe.php"><button>Add Recipe</button></a></li>
            </ul>
        </div>
    </nav>
</header>

<body class="recipeAddFormBody">
    <div class="recipeAddCard, recipeAddAdmin">
        <form method="post" action="recipeUpdate.php?recipeID=<?php echo $recipeID; ?>">
            <h3 class="recipeAddFormH3">Recipe City</h3>
            <div class="recipeFormRow">
                <div class="form-group">
                    <label class="recipeCardFormLabel" for="recipe_author">Author</label>
                    <input class="recipeCardFormInput" type="text" id="author" name="recipe_author" required value="<?php echo $row['recipe_author']; ?>">
                </div>
                <div class="form-group">
                    <label class="recipeCardFormLabel" for="recipe_author_email">Email</label>
                    <input class="recipeCardFormInput" type="email" id="recipeEmail" name="recipe_author_email"
                        placeholder="example@gmail.com" required  value="<?php echo $row['recipe_author_email']; ?>">
                </div>
                <hr class="recipeFormDivider">
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="recipe_title">Recipe Name</label>
                <input class="recipeCardFormInput" type="text" id="title" name="recipe_title" required  value="<?php echo $row['recipe_title']; ?>">
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="recipe_description">Description (max.28 words):</label>
                <textarea class="recipeCardFormTextarea" id="description" name="recipe_description" required><?php echo $row['recipe_description']; ?></textarea>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="recipe_cooktime">Cooking Time</label>
                <input class="recipeCardFormInput" type="number" id="total-time" name="recipe_cooktime" placeholder="#"
                    required value="<?php echo $row['recipe_cooktime']; ?>">
                <select class="recipeCardFormSelect" id="time-description" name="recipe_cooktime_description" required>
                    <option vlaue="" disabled selected>Time Description</option>
                    <option vlaue="Seconds"<?php if($row['recipe_cooktime_description'] == 'Seconds') { echo ' selected'; } ?>>Seconds</option>
                    <option vlaue="Minutes"<?php if($row['recipe_cooktime_description'] == 'Minutes') { echo ' selected'; } ?>>Minutes</option>
                    <option value="Hours"<?php if($row['recipe_cooktime_description'] == 'Hours') { echo ' selected'; } ?>>Hours</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="recipe_yields">Yields</label>
                <input class="recipeCardFormInput" type="number" id="yield" name="recipe_yields" placeholder="#" required value="<?php echo $row['recipe_yields']; ?>">
                <select class="recipeCardFormSelect" id="yield-description" name="recipe_yields_description">
                    <option vlaue="" disabled selected>Yield Description</option>
                    <option vlaue="People"<?php if($row['recipe_yields_description'] == 'People') { echo ' selected'; } ?>>People</option>
                    <option vlaue="Servings"<?php if($row['recipe_yields_description'] == 'Servings') { echo ' selected'; } ?>>Servings</option>
                    <option value="Amount"<?php if($row['recipe_yields_description'] == 'Amount') { echo ' selected'; } ?>>Amount</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="recipe_difficulty">Difficulty</label>
                <select class="recipeCardFormSelect" id="difficulty" name="recipe_difficulty">
                    <option value="" disabled selected>Select Level</option>
                    <option value="Easy"<?php if($row['recipe_difficulty'] == 'Easy') { echo ' selected'; } ?>>Easy</option>
                    <option value="Intermediate"<?php if($row['recipe_difficulty'] == 'Intermediate') { echo ' selected'; } ?>>Intermediate</option>
                    <option value="Advanced"<?php if($row['recipe_difficulty'] == 'Advanced') { echo ' selected'; } ?>>Advanced</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="recipe_cusine">Cusine</label>
                <select class="recipeCardFormSelect" id="cusineType" name="recipe_cusine">
                    <option value="" disabled selected>Select Cusine</option>
                    <option value="American"<?php if($row['recipe_cusine'] == 'American') { echo ' selected'; } ?>>American</option>
                    <option value="European"<?php if($row['recipe_cusine'] == 'European') { echo ' selected'; } ?>>Euopean</option>
                    <option value="African"<?php if($row['recipe_cusine'] == 'African') { echo ' selected'; } ?>>African</option>
                    <option value="Latin American"<?php if($row['recipe_cusine'] == 'Latin American') { echo ' selected'; } ?>>Latin American</option>
                    <option value="Asian"<?php if($row['recipe_cusine'] == 'Asian') { echo ' selected'; } ?>>Asian</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="recipe_category">Category</label>
                <select class="recipeCardFormSelect" id="categoryType" name="recipe_category">
                    <option value="" disabled selected>Select Category</option>
                    <option value="All"<?php if($row['recipe_category'] == 'All') { echo ' selected'; } ?>>All</option>
                    <option value="Breakfast"<?php if($row['recipe_category'] == 'Breakfast') { echo ' selected'; } ?>>Breakfast</option>
                    <option value="Lunch"<?php if($row['recipe_category'] == 'Lunch') { echo ' selected'; } ?>>Lunch</option>
                    <option value="Dinner"<?php if($row['recipe_category'] == 'Dinner') { echo ' selected'; } ?>>Dinner</option>
                    <option value="Dessert"<?php if($row['recipe_category'] == 'Dessert') { echo ' selected'; } ?>>Dessert</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel">Ingredients</label>
                <div id="ingredientInputs">
                    <textarea class="recipeCardFormTextarea" name="recipe_ingredients[]" style="height: 23px;"
                        placeholder="Sugar" required><?php echo $row['recipe_ingredients']; ?></textarea>
                </div>
                <button type="button" class="add-btn" onclick="addIngredientInput()">Add Ingredient</button>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel">Instructions</label>
                <div id="instructionInputs">
                    <textarea class="recipeCardFormTextarea" name="recipe_instructions[]" style="height: 23px;"
                        placeholder="Add the sugar to bowl..." required><?php echo $row['recipe_instructions']; ?></textarea>
                </div>
                <button type="button" class="add-btn" onclick="addInstructionInput()">Add Instruction</button>
            </div>
            <div class="parentContainer">
                <div class="sectionRecipeForm1">
                    <p>* All asterisk fields must be field out in order to proplery place your added recipe and to submit
                        this
                        form.
                    </p>
                </div>
                <div class="sectionRecipeForm2">
                    <input type="submit" name="submit" id="recipeInputSubmit" value="submit">
                    <input type="reset" value="Reset" id="recipeInputReset">
                </div>
            </div>
        </form>
    </div>
    <?php
}  //ends the display of the form to the user when requested 
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
        <p class="copyright">&copy;
            <?php echo date('Y'); ?> Recipe City
        </p>
        <a href="#top" class="backToTop"><img src="../images/icons8-up-50.png"></a>
    </footer>
</body>

</html>