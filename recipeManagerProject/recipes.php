<?php 

require '../dbConnect.php';

// Retrieve the recipe data from the database
$stmt = $conn->prepare("SELECT * FROM wdv341_recipes");
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta description="A recipe website that features recipes and allows you to enter your own recipes.">
    <meta keywords="Recipe, cooking, recipes, meals, Recipe City">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Recipe City</title>
    <!--Sydney Mehre 04/09/2023-->
    <script>
        const recipeObjects = [];
        for (let i = 0; i < localStorage.length; i++) {
            const key = localStorage.key(i);
            if (key === "recipeObject") {
                const recipeObject = JSON.parse(localStorage.getItem(key));
                console.log(recipeObject);
                recipeObjects.push(recipeObject);
            }
        }

        function createRecipeCard(recipeObject) {
            const recipeCard = document.createElement("div");
            recipeCard.classList.add("recipe-card");
            recipeCard.classList.add("card-height");

            const recipeImg = document.createElement("img");
            recipeImg.src = recipeObject.img;
            recipeImg.alt = recipeObject.title;

            const recipeTitle = document.createElement("h2");
            recipeTitle.textContent = recipeObject.title;

            const recipeDescription = document.createElement("p");
            recipeDescription.textContent = recipeObject.description;


            recipeCard.appendChild(recipeImg);
            recipeCard.appendChild(recipeTitle);
            recipeCard.appendChild(recipeDescription);
           

            recipeCard.addEventListener("click", () => {
                console.log("clicked");
                localStorage.setItem("selectedRecipe", JSON.stringify(recipeObject));
                navigateToRecipeTemplate();
            });

            return recipeCard;
        }

        function navigateToRecipeTemplate() {
            window.location.href = "recipeTemplate.php";
        }


        document.addEventListener("DOMContentLoaded", () => {
        const recipeObjects = JSON.parse(localStorage.getItem("recipeObjects")) || [];
        const recipeContainer = document.querySelector("#recipeContainer");
        const filterButtons = document.querySelectorAll('.filter-topic');
        const formRows = document.querySelectorAll('.form-row');

        recipeObjects.forEach((recipeObject, index) => {
            const recipeCard = createRecipeCard(recipeObject, index);
            recipeContainer.appendChild(recipeCard);
        });

        const recipeCards = document.querySelectorAll('.recipe-card');
        recipeCards.forEach(recipeCard => {
            recipeCard.addEventListener('click', () => {
                const recipeId = recipeCard.dataset.recipeId;
                window.location.href = `recipeTemplate.php?id=${recipeId}`;
            });
        });

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const filter = button.dataset.filter;
                formRows.forEach(row => {
                    if (row.classList.contains(filter)) {
                        row.style.display = 'block';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        const filterForm = document.querySelector('.filter-form');

        filterForm.addEventListener('submit', event => {
            event.preventDefault();

        
            const formData = new FormData(filterForm);
            const checkedValues = {};
            formData.forEach((value, name) => {
                if (value) {
                    if (checkedValues[name]) {
                        checkedValues[name].push(value);
                    } else {
                        checkedValues[name] = [value];
                    }
                }
            });

        
            console.log(checkedValues);
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
                <li><a href="./administratorRights/login.php"><img src="images/icons8-account-64.png" height="30px"
                            class="accountIcon" alt="account"></a></li>
                <li><a href="inputRecipe.php"><button>Add Recipe</button></a></li>
            </ul>
        </div>
    </nav>
</header>
<div id="container">
    <div class="column1">
        <h1>Recipes</h1>
        <p>Welcome to our recipe page! Here, you'll find a wide variety of delicious recipes that are pefect for
            any occasion.
            Whether you're a seasoned chef or a beginner in the kitchen, our step-by-step instructions and
            helpful tips will guide you through
            the cooking process and help you create mouth-watering meals that your family and friends will love.
            So why wait? Let's get cooking!
        </p>
        <div class="recipeSearchBox">
            <form class="search-form" action="#" method="post">
                <input type="text" class="special" name="search" placeholder="Search recipes...">
                <button type="submit"><img src="images/blackSearchIcon.png"></button>
            </form>
        </div>
    </div>
    <div class="column2">
        <img src="images/pexels-cottonbro-studio-3338497.jpg" height="919px;" width="700px;" alt="">
        <hr>
    </div>
</div>
<div class="main-container">
    <div class="columnNumberOne">
        <div class="filter-box">
            <h2 class="filterRecipes">Filter Recipes</h2>
            <div class="filter-topics">
                <button class="filter-topic" data-filter="skill-level">Skill</button>
                <button class="filter-topic" data-filter="category-type">Category</button>
                <button class="filter-topic" data-filter="cuisine-type">Cuisine</button>
            </div>
            <form class="filter-form">
                <div class="form-row skill-level" style="display:none;">
                    <p>Skill Level</p>
                    <div>
                        <input type="radio" name="skill-level" value="Easy" id="easy">
                        <label for="easy">Easy</label>
                    </div>
                    <div>
                        <input type="radio" name="skill-level" value="Intermediate" id="intermediate">
                        <label for="intermediate">Intermediate</label>
                    </div>
                    <div>
                        <input type="radio" name="skill-level" value="Advanced" id="advanced">
                        <label for="advanced">Advanced</label>
                    </div>
                </div>
                <div class="form-row category-type" style="display:none;">
                    <p>Category Type</p>
                    <div>
                        <input type="checkbox" name="category-type" value="Breakfast" id="breakfast">
                        <label for="breakfast">Breakfast</label>
                    </div>
                    <div>
                        <input type="checkbox" name="category-type" value="Lunch" id="lunch">
                        <label for="lunch">Lunch</label>
                    </div>
                    <div>
                        <input type="checkbox" name="category-type" value="Dinner" id="dinner">
                        <label for="dinner">Dinner</label>
                    </div>
                    <div>
                        <input type="checkbox" name="category-type" value="Dessert" id="dessert">
                        <label for="dessert">Dessert</label>
                    </div>
                </div>
                <div class="form-row cuisine-type" style="display:none;">
                    <p>Cuisine Type</p>
                    <div>
                        <input type="checkbox" name="cuisine-type" value="American" id="american">
                        <label for="american">American</label>
                    </div>
                    <div>
                        <input type="checkbox" name="cuisine-type" value="European" id="european">
                        <label for="european">European</label>
                    </div>
                    <div>
                        <input type="checkbox" name="cuisine-type" value="African" id="african">
                        <label for="african">African</label>
                    </div>
                    <div>
                        <input type="checkbox" name="cuisine-type" value="Latin-American" id="latin">
                        <label for="latin">Latin American</label>
                    </div>
                    <div>
                        <input type="checkbox" name="cuisine-type" value="Asian" id="asian">
                        <label for="asian">Asian</label>
                    </div>
                </div>
                <button type="submit" class="filterButton">Filter</button>
            </form>
        </div>
    </div>
</div>
<div id="recipeContainer">
        <?php foreach ($recipes as $recipe): ?>
        <?php
                $stmt = $conn->prepare("SELECT recipe_food_image FROM wdv341_recipes WHERE id = :id");
                $stmt->bindParam(':id', $recipe['id']);
                $stmt->execute();
                $row = $stmt->fetch();

                $imageData = $row['recipe_food_image'];

                $imageType = 'image/jpeg';
                $imageDataUri = 'data:' . $imageType . ';base64,' . base64_encode($imageData);

            ?>

        <div class="recipe-card" data-recipe-id="<?php echo $recipe['id']; ?>">
        <img src="<?php echo $imageDataUri; ?>" alt="Recipe Image">
            <h2>
                <?php echo $recipe['recipe_title']; ?>
            </h2>
            <p>
                <?php echo $recipe['recipe_description']; ?>
            </p>
        </div>
        <?php endforeach; ?>
    <div class="columnNumberTwo">
    </div>
</div>



<footer class="recipeFooter">
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
    <p class="copyright">&copy;
        <?php echo date('Y'); ?> Recipe City
    </p>
    <a href="#top" class="backToTop"><img src="images/icons8-up-50.png"></a>
</footer>

</body>

</html>