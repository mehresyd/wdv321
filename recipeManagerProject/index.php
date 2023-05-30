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
</head>

<body>
  <header>
    <div class="banner"></div>
    <div class="heading-wrapper">
      <h1>RECIPE CITY</h1>
      <h3>Home of the best recipes. Learn how to make all your favorite dishes</h3>
      <div class="search-container">
        <input class="search-box" type="text" placeholder="I want to make...">
        <select class="dropdown">
          <option class="categories" value="categories">Categories</option>
          <option value="all">All</option>
          <option value="breakfast">Breakfast</option>
          <option value="lunch">Lunch</option>
          <option value="dinner">Dinner</option>
          <option value="dessert">Dessert</option>
        </select>
        <div class="search-icon-container">
          <img src="images/searchIcon.png" height="30px" alt="search icon">
        </div>
      </div>
    </div>
    <nav>
      <div class="logo">
        <a href="index.php"><img src="images/RC-1.png" height="75px" alt="Recipe City Logo"></a>
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
  <div id="container">
    <div class="introduction">
      <h1>Recipes Galore</h1>
      <p>Welcome to Recipe City, a one-stop-shop for all your culinary needs. Whether you're a seasoned home cook or a
        newbie in the kitchen,
        we've got you covered with a vast collection of mouth-watering recipes from around the world. Our user-friendly
        site lets you browse
        through recipes and discover new dishes that fit your taste, preferences, and dietary needs. From vegan to
        gluten-free, low-carb to high-protien, we
        have recipes for everyone.
      </p>
      <p>
        Our website is not just about reading recipes - we believe that cooking is a social activity, and that's why we
        implore you to engage with
        our online cooking community. You can review and rate recipes, leave comments and suggestions, and even share
        your own recipes with the world.
        Our recipe manager website is all about creating a supportive environment where food enthusiasts can come
        together, share their knowledge and passion
        and inspire each other to create. So, put on your apron, grab your inredients, and let's get cooking!
      </p>
      <img src="images/steak.png" width="300px" alt="A dish of steak and veggies">
      <h1 class="categories">Categories</h1>
      <p>Recipe City offers food categories to suit every meal of the day. For breakfast, we have an assortment of
        classic
        dishes such as pancakes, waffles, and eggs benedict, as well as healthy options such as smoothie bowls and
        overnight oats. If you're
        looking for a quick and easy lunch, our site features a range of sandwhiches, salads and soups that can be
        whipped up in no time. For dinner,
        we have an extensive collection of comfort food classics, including pastas, casseroles, and hearty stwes. And of
        course we didn't forget dessert.
        We have a wide selections of cakes, cookies, pies and more!
      </p>
      <div class="image-row">
        <div class="image-container">
          <img src="images/breakfast.png" alt="breakfast">
          <div class="image-text">Breakfast</div>
        </div>
        <div class="image-container">
          <img src="images/lunch.png" alt="lunch">
          <div class="image-text">Lunch</div>
        </div>
        <div class="image-container">
          <img src="images/dinner.png" alt="dinner">
          <div class="image-text">Dinner</div>
        </div>
        <div class="image-container">
          <img src="images/pexels-melanie-dompierre-1707920.png" alt="dessert">
          <div class="image-text">Dessert</div>
        </div>
      </div>
      <div class="banner2">
        <h1>Explore Recipes</h1>
        <p>Explore thousands of worldwide recipes right at your finger tips</p>
        <a href="recipes.php"><button>Recipes</button></a>
        <img src="images/banner5.jpg" alt="food sharing">
      </div>
      <div>
        <h1 class="popularRecipes">Popular Recipes</h1>
        <p>Recipe City offers a wide vairety of popular recipes to choose from. Filter through some of our best and top
          rated recipes
          and find your new favorite dish.
        </p>
      </div>
      <div class="slider-wrapper">
        <div class="image-slider">
          <div class="images">
            <img src="images/chicken_pho.jpg" alt="chicken pho">
            <img src="images/spicyVodkaPastajpg.jpg" alt="spicy vodka pasta">
            <img src="images/Pozole-verde-2067167974.jpg" alt="Pazole verde">
            <img src="images/pexels-caramelle-gastronomia-4529015.jpg" alt="key lime pie">
          </div>
        </div>
        <div class="arrows">
          <button class="prev-button">&#10094;</button>
          <button class="next-button">&#10095;</button>
        </div>
      </div>
      <div>
        <h1 class="review">Testimonials</h1>
        <p>Take time to review what other cooks like you are saying about us and our recipes!</p>
      </div>
      <div class="testimonial-slider">
        <div class="testimonials">
          <div class="testimonial active">
            <p>"I loved the recipes! Exceeded expectations."</p>
            <span class="name">John Doe</span>
          </div>
          <div class="testimonial active">
            <p>"The customer service was exceptional."</p>
            <span class="name">Jane Smith</span>
          </div>
          <div class="testimonial active">
            <p>"I've love Recipe City. Can find any recipe I need."</p>
            <span class="name">Bob Johnson</span>
          </div>
        </div>
        <div class="dots">
          <span class="dot active"></span>
          <span class="dot"></span>
          <span class="dot"></span>
        </div>
      </div>
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