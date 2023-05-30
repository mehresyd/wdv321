<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="A recipe website that features recipes and allows you to enter your own recipes.">
    <meta keywords="Recipe, cooking, recipes, meals, Recipe City">
    <link rel="stylesheet" href="style.css">
    <title>Recipe City</title>
    <!--Sydney Mehre 04/09/2023-->
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
            newTextarea.setAttribute("name", "ingredientList[]");
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
            newTextarea.setAttribute("name", "instructionList[]");
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


        function createRecipeObject(event) {
            event.preventDefault(); // prevent form submission behavior

            // get form inputs
            const author = document.querySelector("#author").value;
            const email = document.querySelector("#recipeEmail").value;
            const title = document.querySelector("#title").value;
            const description = document.querySelector("#description").value;
            const totalTime = document.querySelector("#total-time").value;
            const timeDescription = document.querySelector("#time-description").value;
            const yieldAmount = document.querySelector("#yield").value;
            const yieldDescription = document.querySelector("#yield-description").value;
            const difficulty = document.querySelector("#difficulty").value;
            const cuisine = document.querySelector("#cusineType").value;
            const category = document.querySelector("#categoryType").value;
            const ingredients = Array.from(document.querySelectorAll("#ingredientInputs textarea"))
                .map(input => input.value)
                .filter(value => value.trim() !== "");
            const instructions = Array.from(document.querySelectorAll("#instructionInputs textarea"))
                .map(input => input.value)
                .filter(value => value.trim() !== "");
            const img = document.querySelector('#foodImage').files[0];

            // create FileReader object to read the image data
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = () => {

                // create recipe object
                const recipeObject = {
                    author,
                    email,
                    title,
                    description,
                    totalTime: `${totalTime} ${timeDescription}`,
                    yield: `${yieldAmount} ${yieldDescription}`,
                    difficulty,
                    cuisine,
                    category,
                    ingredients,
                    instructions,
                    img: reader.result
                };

                const recipeObjects = JSON.parse(localStorage.getItem("recipeObjects")) || [];
                recipeObjects.push(recipeObject);

                localStorage.setItem("recipeObjects", JSON.stringify(recipeObjects));

                // clear form inputs
                document.querySelector("#author").value = "";
                document.querySelector("#recipeEmail").value = "";
                document.querySelector("#title").value = "";
                document.querySelector("#description").value = "";
                document.querySelector("#total-time").value = "";
                document.querySelector("#time-description").selectedIndex = 0;
                document.querySelector("#yield").value = "";
                document.querySelector("#yield-description").selectedIndex = 0;
                document.querySelector("#difficulty").selectedIndex = 0;
                document.querySelector("#cusineType").selectedIndex = 0;
                document.querySelector("#categoryType").selectedIndex = 0;
                document.querySelector('#foodImage').value = "";
                document.getElementsByName("ingredientList[]").forEach(input => input.value = "");
                document.getElementsByName("instructionList[]").forEach(input => input.value = "");

                console.log(recipeObject);

                alert("Recipe created successfully!");
            };
        }

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
    <div class="inputRecipePageContainer">
        <div class="imageContainer">
            <img src="images/coffeeCake.jpg" width="200px" class="inputRecipeImg" alt="Image 1">
            <img src="images/curry.jpg" width="200px" class="inputRecipeImg" alt="Image 2">
            <img src="images/salads.jpg" width="200px" class="inputRecipeImg" alt="Image 3">
            <img src="images/dumplings.jpg" width="200px" class="inputRecipeImg" alt="Image 4">
            <img src="images/pestoPasta.jpg" width="200px" class="inputRecipeImg" alt="Image 5">
        </div>
        <div class="inputRecipe">
            <h1>Add Your Own Recipe</h1>
            <p>Have recipes you want to share? With our easy to use form, you can create and share your favorite
                recipes! Simply
                input the ingredients, steps, and any additonal information, and we'll take care of the rest!
            </p>
            <hr class="inputRecipeBreakLine">
            <p>Together, we can create a platform that's as diverse and delicious as the meals we love to make.</p>
        </div>
    </div>
    <div class="recipeCardHead">
        <h1>Recipe Card</h1>
    </div>
    <div class="tabby"></div>
    <div class="recipeAddCard">
        <form onsubmit="createRecipeObject(event)">
            <div class="recipeFormRow">
                <div class="form-group">
                    <label class="recipeCardFormLabel" for="author">Author</label>
                    <input class="recipeCardFormInput" type="text" id="author" name="author" required>
                </div>
                <div class="form-group">
                    <label class="recipeCardFormLabel" for="email">Email</label>
                    <input class="recipeCardFormInput" type="email" id="recipeEmail" name="email"
                        placeholder="example@gmail.com" required>
                </div>
                <hr class="recipeFormDivider">
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="title">Recipe Name</label>
                <input class="recipeCardFormInput" type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="description">Description (max.28 words):</label>
                <textarea class="recipeCardFormTextarea" id="description" name="description" maxlength="140" oninput="countWords()" required></textarea>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="total-time">Cooking Time</label>
                <input class="recipeCardFormInput" type="number" id="total-time" name="total-time" placeholder="#"
                    required>
                <select class="recipeCardFormSelect" id="time-description" name="time-description" required>
                    <option vlaue="" disabled selected>Time Description</option>
                    <option vlaue="Seconds">Seconds</option>
                    <option vlaue="Minutes">Minutes</option>
                    <option value="Hours">Hours</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="yield">Yields</label>
                <input class="recipeCardFormInput" type="number" id="yield" name="yield" placeholder="#" required>
                <select class="recipeCardFormSelect" id="yield-description" name="yield-description" required>
                    <option vlaue="" disabled selected>Yield Description</option>
                    <option vlaue="People">People</option>
                    <option vlaue="Servings">Servings</option>
                    <option value="Amount">Amount</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="difficulty">Difficulty</label>
                <select class="recipeCardFormSelect" id="difficulty" name="difficulty" required>
                    <option value="" disabled selected>Select Level</option>
                    <option value="Easy">Easy</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="cusineType">Cusine</label>
                <select class="recipeCardFormSelect" id="cusineType" name="cusineType" required>
                    <option value="" disabled selected>Select Cusine</option>
                    <option value="American">American</option>
                    <option value="European">Euopean</option>
                    <option value="African">African</option>
                    <option value="Latin American">Latin American</option>
                    <option value="Asian">Asian</option>
                </select>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="categoryType">Category</label>
                <select class="recipeCardFormSelect" id="categoryType" name="categoryType" required>
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
                    <textarea class="recipeCardFormTextarea" name="ingredientList[]" style="height: 23px;"
                        placeholder="Sugar" required></textarea>
                </div>
                <button type="button" class="add-btn" onclick="addIngredientInput()">Add Ingredient</button>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel">Instructions</label>
                <div id="instructionInputs">
                    <textarea class="recipeCardFormTextarea" name="instructionList[]" style="height: 23px;"
                        placeholder="Add the sugar to bowl..." required></textarea>
                </div>
                <button type="button" class="add-btn" onclick="addInstructionInput()">Add Instruction</button>
            </div>
            <div class="form-group">
                <label class="recipeCardFormLabel" for="foodImage">Upload Image:</label>
                <input class="recipeCardFormInput" name="foodImage" id="foodImage" type="file" accept="image/*" required>
            </div>
    </div>
    <div class="parentContainer">
        <div class="sectionRecipeForm1">
            <p>* All asterisk fields must be field out in order to proplery place your added recipe and to submit this
                form.</p>
        </div>
        <div class="sectionRecipeForm2">
            <input type="submit" name="submit" id="recipeInputSubmit" value="Submit">
            <input type="reset" value="Reset" id="recipeInputReset">
        </div>
    </div>
    </div>
    </form>
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