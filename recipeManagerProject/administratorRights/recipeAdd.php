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


$formRequested = true;
$validForm = true;
$recipeAuthor = "";
$recipeAuthorEmail = "";
$recipeTitle = "";
$recipeDescription = "";
$recipeCooktime = "";
$recipeCooktimeDescription = "";
$recipeYields = "";
$recipeYieldsDescription = "";
$recipeDifficulty = "";
$recipeCusine = "";
$recipeCategory = "";
$recipeIngredients = "";
$recipeInstructions = "";
$message = '';


if (isset($_POST['submit'])) {
    if (!empty($_POST['recipeNumber'])) {
      header('Location: recipeAdd.php');
      exit();
    }


if ($validForm) {
    // form processing code here
    $message = 'Recipe added successfully.';
} else {
    $message = 'Please fill out all fields.';
}
     
  $recipeAuthor = $_POST['recipe_author'];
  $recipeAuthorEmail = $_POST['recipe_author_email'];
  $recipeTitle = $_POST['recipe_title'];
  $recipeDescription = $_POST['recipe_description'];
  $recipeCooktime = $_POST['recipe_cooktime'];
  $recipeCooktimeDescription = $_POST['recipe_cooktime_description'];
  $recipeYields = $_POST['recipe_yields'];
  $recipeYieldsDescription = $_POST['recipe_yields_description'];
  $recipeDifficulty = $_POST['recipe_difficulty'];
  $recipeCusine = $_POST['recipe_cusine'];
  $recipeCategory = $_POST['recipe_category'];
  $recipeIngredients = implode("\n", $_POST['recipe_ingredients']);
  $recipeInstructions = implode("\n", $_POST['recipe_instructions']);



  if (empty($recipeAuthor) || empty($recipeAuthorEmail) || empty($recipeTitle) || empty($recipeDescription) || empty($recipeCooktime) || empty($recipeCooktimeDescription) || empty($recipeYields)  || empty($recipeYieldsDescription) || empty($recipeDifficulty) || empty($recipeCusine) || empty($recipeCategory) || empty($recipeIngredients) || empty($recipeInstructions)) {
    $validForm = false;
  }

  if ($validForm) {
    try {
      $currentDateTime = date("Y-m-d H:i:s");
      $sql = "INSERT INTO wdv341_recipes (recipe_author, recipe_author_email, recipe_title, recipe_description, recipe_cooktime, recipe_cooktime_description, recipe_yields, recipe_yields_description, recipe_difficulty, recipe_cusine, recipe_category, recipe_ingredients, recipe_instructions) VALUES (:recipe_author, :recipe_author_email, :recipe_title, :recipe_description, :recipe_cooktime, :recipe_cooktime_description, :recipe_yields, :recipe_yields_description, :recipe_difficulty, :recipe_cusine, :recipe_category, :recipe_ingredients, :recipe_instructions)";
      $stmt = $conn->prepare($sql);

     
      $stmt->bindParam(':recipe_author', $recipeAuthor);
      $stmt->bindParam(':recipe_author_email', $recipeAuthorEmail);
      $stmt->bindParam(':recipe_title', $recipeTitle);
      $stmt->bindParam(':recipe_description', $recipeDescription);
      $stmt->bindParam(':recipe_cooktime', $recipeCooktime);
      $stmt->bindParam(':recipe_cooktime_description', $recipeCooktimeDescription);
      $stmt->bindParam(':recipe_yields', $recipeYields);
      $stmt->bindParam(':recipe_yields_description', $recipeYieldsDescription);
      $stmt->bindParam(':recipe_difficulty', $recipeDifficulty);
      $stmt->bindParam(':recipe_cusine', $recipeCusine);
      $stmt->bindParam(':recipe_category', $recipeCategory);
      $stmt->bindParam(':recipe_ingredients', $recipeIngredients);
      $stmt->bindParam(':recipe_instructions', $recipeInstructions);


      $stmt->execute();
      $formRequested = false;

    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
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
    <title>Recipe City Add Recipe's</title>
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

        .message {
            margin-left: 580px;
            margin-top: 50px;
            font-weight: bold;
            margin-bottom: 500px;
        }

        .message.green {
            color: green;
        }

        .message.red {
            color: red;
        }
        
        /*honeypot*/
    
        #phoneLabel, #phone {
         display: none;
        }

        .addAnotherRecipe a {
            color: black;  
            
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
                <li><a href="login.php"><img src="../images/icons8-account-64.png" height="30px" class="accountIcon" alt="account"></a></li>
                <li><a href="../inputRecipe.php"><button>Add Recipe</button></a></li>
            </ul>
        </div>
    </nav>
</header>
<body class="recipeAddFormBody">
    <h1>Administrator Recipe Input Form</h1>
    <p class="recipeAddParagraph">Add a new event to the database.</p>
    <?php 
    
    if (!empty($message)) {
        if ($_SERVER['REQUEST_METHOD']  === 'POST') {
            $color = 'green';
        } else {
            $color = 'red'; 
        }
    ?>
        <div class="message <?php echo $color; ?>">
        <p><?php echo $message; ?></p>
        <p class="addAnotherRecipe"><a href="recipeAdd.php">Add another recipe</a></p>
        </div>
    <?php
        }
    ?>

    <?php
      if ($validForm === false) {
        echo "<p style='color:red'>Please fill out all required fields.</p>";
      }
    ?>

<?php if($formRequested): ?>
    <div class="recipeAddCard, recipeAddAdmin">
        <form id="addRecipeForm" method="post" action="recipeAdd.php" class="recipe-form" enctype="multipart/form-data"> 
                <h3 class="recipeAddFormH3">Recipe City</h3>
                <div class="recipeFormRow">
                        <div class="form-group">
                            <label class="recipeCardFormLabel" for="recipe_author">Author</label>
                            <input class="recipeCardFormInput" type="text" id="author" name="recipe_author" required>
                        </div>
                        <div class="form-group">
                            <label class="recipeCardFormLabel" for="recipe_author_email">Email</label>
                            <input class="recipeCardFormInput" type="email" id="recipeEmail" name="recipe_author_email" placeholder="example@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label class="recipeCardFormLabel" id="phoneLabel" for="recipeNumber">Mobile number</label>
                            <input class="recipeCardFormInput" type="text" name="recipeNumber" id="phone"> 
                        </div>
                        <hr class="recipeFormDivider">
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel" for="recipe_title">Recipe Name</label>
                        <input class="recipeCardFormInput" type="text" id="title" name="recipe_title" required>
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel" id="descriptionLabel" for="recipe_description">Description:</label>
                        <textarea class="recipeCardFormTextarea" id="description" name="recipe_description"  required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel" for="recipe_cooktime">Cooking Time</label>
                        <input class="recipeCardFormInput" type="number" id="total-time" name="recipe_cooktime" placeholder="#" required>
                        <select class="recipeCardFormSelect" id="time-description" name="recipe_cooktime_description" required>
                            <option vlaue="" disabled selected>Time Description</option>
                            <option vlaue="Seconds">Seconds</option>
                            <option vlaue="Minutes">Minutes</option>
                            <option value="Hours">Hours</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel" for="recipe_yields">Yields</label>
                        <input class="recipeCardFormInput" type="number" id="yield" name="recipe_yields" placeholder="#" required>
                        <select class="recipeCardFormSelect" id="yield-description" name="recipe_yields_description" required>
                            <option vlaue="" disabled selected>Yield Description</option>
                            <option vlaue="People">People</option>
                            <option vlaue="Servings">Servings</option>
                            <option value="Amount">Amount</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel" for="recipe_difficulty">Difficulty</label>
                        <select class="recipeCardFormSelect" id="difficulty" name="recipe_difficulty" required>
                            <option value="" disabled selected>Select Level</option>
                            <option value="Easy">Easy</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel" for="recipe_cusine">Cusine</label>
                        <select class="recipeCardFormSelect" id="cusineType" name="recipe_cusine" required>
                            <option value="" disabled selected>Select Cusine</option>
                            <option value="American">American</option>
                            <option value="European">Euopean</option>
                            <option value="African">African</option>
                            <option value="Latin American">Latin American</option>
                            <option value="Asian">Asian</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel" for="recipe_category">Category</label>
                        <select class="recipeCardFormSelect" id="categoryType" name="recipe_category" required>
                            <option value="" disabled selected>Select Category</option>
                            <option value="All">All</option>
                            <option value="Breakfast">Breakfast</option>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                            <option value="Dessert">Dessert</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label class="recipeCardFormLabel">Ingredients</label>
                    <div id="ingredientInputs">
                        <textarea class="recipeCardFormTextarea" name="recipe_ingredients[]" style="height: 23px;"
                            placeholder="Sugar" required></textarea>
                    </div>
                    <button type="button" class="add-btn" onclick="addIngredientInput()">Add Ingredient</button>
                    </div>
                    <div class="form-group">
                        <label class="recipeCardFormLabel">Instructions</label>
                        <div id="instructionInputs">
                            <textarea class="recipeCardFormTextarea" name="recipe_instructions[]" style="height: 23px;"
                                placeholder="Add the sugar to bowl..." required></textarea>
                        </div>
                        <button type="button" class="add-btn" onclick="addInstructionInput()">Add Instruction</button>
                    </div>
                </div>
                <div class="parentContainer">
                    <div class="sectionRecipeForm1">
                        <p>* All asterisk fields must be field out in order to proplery place your added recipe and to submit this
                            form.</p>
                    </div>
                    <div class="sectionRecipeForm2">
                        <input type="submit" name="submit" id="recipeInputSubmit" value="submit">
                        <input type="reset" value="Reset" id="recipeInputReset">
                    </div>
                </div>
            </div>    
        </form> 
    </div>
<?php endif; ?>
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