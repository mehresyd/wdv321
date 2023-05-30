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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function validateForm() {

            let name = document.querySelector("#name").value;


            let names = /^[a-zA-Z ]*$/;
            if (!names.test(name)) {
                alert("Error: Names can only contain letters and spaces.");
                return false;
            }

            let comment = document.querySelector("#comment").value;
            if (comment.trim().split(/\s+/).length > 100) {
                alert("Error: Your comment exceeds the maximum character count of 100.");
                return false;
            }

            let recaptcha = document.querySelector(".g-recaptcha-response").value;
            if (recaptcha === "") {
                alert("Error: Please complete the reCAPTCHA.");
                return false;
            }

            return true;
        }
    </script>
    <!--Sydney Mehre 04/09/2023-->
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
    <div id="mainForm">
        <div class="contactUs">
            <div class="contactHeading">
                <h2>Contact Us</h2>
                <div class="paragraphs">
                    <p>We love hearing from you! If you have any questions, comments, suggestions or more please don't
                        hesitate to get in touch
                        with us. You can fill out the contact form or send us an email, text, or call with the
                        information provided
                        below. We'll do our beset to respond to your message as soon as possible.</p>
                    <p>Phone Number: (515) 123-4567<br>Email: recipeCity@gmail.com</p>
                    <p>Thank you for your suppport of Recipe City!</p>
                </div>
            </div>
            <form method="post" action="recipeContactForm.php" name="contactForm" id="contactRecipeForm"
                onsubmit="return validateForm();">
                <fieldset>
                    <div class="flex-form">
                        <label for="name" class="required">Name</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="flex-form">
                        <label for="email" class="required">E-mail</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="flex-form">
                        <label for="mobile" class="required">Mobile</label>
                        <input type="text" name="mobile" id="mobile" placeholder="515-123-4567">
                    </div>
                    <div class="flex-form">
                        <label for="selectSubject" class="required">Subject:</label>
                        <select name="selectSubject">
                            <option value="" disabled selected>Please select a subject</option>
                            <option value="'general inquiry'">General Inquiry</option>
                            <option value="'customer support'">Customer Support</option>
                            <option value="'feedback'">Feedback</option>
                            <option value="'other'">Other</option>
                        </select>
                    </div>
                    <div class="flex-form">
                        <label for="message" class="required">Comment:</label>
                        <textarea name="comment" id="comment"></textarea>
                    </div>
                    <div class="flex-form1">
                        <label for="address" class="address">Address</label>
                        <input type="text" name="address" id="address">
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Ley6y8lAAAAAM4GzBF_nlmAH77lxnkvtu3ct_K8"></div>
                </fieldset>
                <div class="flex-buttons">
                    <input type="submit" name="submit" class="submitFormButton" value="Submit">
                    <input type="reset" class="resetFormButton" value="Reset">
                </div>
            </form>
        </div>
        <div id="sidebar">
            <img src="images/Meal-PNG-File-Download-Free-2170393469.png">
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