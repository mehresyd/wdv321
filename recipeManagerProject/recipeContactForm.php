<?php

$secretKey = "6Ley6y8lAAAAABb1UkQxarBfR-M9asZm79HGl6dv";

if (isset($_POST['submit'])) {
    $captcha = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $secretKey,
        'response' => $captcha
    );

    //Chcking honeypot field
    if (!empty($_POST['address'])) {
        // Access Denied
        exit("Access Denied. Please try again. <br><a href='contact.php'>Return to contact form</a>");
    }

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ),
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $json = json_decode($response, true);

    if (empty($captcha)) {
        // reCAPTCHA failed
        $to = "mehresyd@sydneymehre.com";
        $subject = "Contact Form Submission - reCAPTCHA verification failed";
        $message = "An attempt was made to access a contact form, but reCAPTCHA verification failed.";
        mail($to, $subject, $message);
        exit("Error: reCAPTCHA verification failed. Please try again. <br><a href='contact.html'>Return to contact form</a>");
    } 
    else {
        // reCAPTCHA succeeded
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $selectSubject = $_POST['selectSubject'];
        $comment = $_POST['comment'];

        date_default_timezone_set('America/Chicago');
        $date = date('m/d/Y');

        //  set content-type when sending HTML email
        $headers = 'MIME-Version: 1.0' . "\r\n" .
        'Content-type:text/html;charset=UTF-8' . "\r\n" .
        'From: <mehresyd@sydneymehre.com>' . "\r\n" .
        'Reply-To: $email' . "r\n";

        // Send confirmation email to user
        $to = $email;
        $subject = "Recipe City Form Submission";
        $message = "
        <html>
        <head>
        <title>Confirmation</title>
        <link rel='stylesheet' href='style.css'>
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
        </head>
        <body>
            <div>
            <header style='padding: 10px 0;'>
            <img src='http://sydneymehre.com/home/wdv321/recipeManagerProject/images/RC-Logo2.png' width='130px;' style='display: block; margin: auto;' alt=\"Recipe City Logo\">
            <h4 style='color: #232323; text-transform: uppercase; font-family: barlow, sans-serif; font-weight: 300; text-align: center'>Recipe City</h4>
            </header>
            <main>
            <div style='font-family: \"Segoe UI\", Tahoma, Geneva, Verdana, sans-serif; font-size: 1em; padding-top: 0.5em;'>
                <p style='font-size: 16px;'>Hello $name,</p>
                <p style='font-size: 16px;'>Thank you for submitting your information through Recipe City's contact form on $date concerning the subject of $selectSubject.</p>
                <p style='font-size: 16px;'>We have recieved your message and will respond back to you as soon as possible through $email.</p>
                <p style='font-size: 16px;'>You have shared the following comment which we will review:</p>
                <p style='font-size: 16px;'>$comment</p>

                <p style='font-size: 16px;'>We thank you for reaching out to us and your support.</p>
                <p style='font-size: 16px;'>Recipe City</p>
                <br>
            </div>
            </main>
            <hr style='backgroundColor: #232323; max-width: 40%; margin-left: 30%;'>
                <h2>Recipe City</h2>
                <br>
                <h5>515-123-4567 | recipeCity@gmail.com</h5><br>
            <footer style='backgroundColor: #232323; color:white;'>
                <p>&copy Recipe City 2023</p>
            </footer>
        </body>
        </html>
    ";

mail($to,$subject,$message,$headers); //sending to client

$to = 'mehresyd@sydneymehre.com';
$subject = "Contact Form Submission from $name";
$message = "Name: $name\nEmail: $email\nMobile: $mobile\nSubject: $selectSubject\nComment: $comment\nDate of Contact: $date";

mail($to, $subject, $message); //sending to myself

 
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe City</title>
    <meta keywords="Recipe, cooking, recipes, meals, Recipe City">
    <meta description="A recipe website that features recipes and allows you to enter your own recipes.">
    <link rel="stylesheet" href="style.css">
    <style>
        .logo {
            margin-bottom: 5px;
        }
    </style>
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
<body class="confirmationRecipePage">
    <div id="contactFormContainer">
        <h3>Thanks for contacting Recipe City!</h3>
            <div class="contactFormConfirmation">
                <div class="confirmationText">
                    <p>Hello
                        <?php echo $name; ?>.
                    </p>
                    <p>We have sucessfully recieved your information sent out on
                        <?php echo $date; ?>.
                    </p>
                    <p>Please check your email inbox as we have sent over a confirmation email to
                        <?php echo $email; ?>. If your confirmation email does not show up right away,
                        make sure to check your spam/junk inbox.
                    </p>
                    <p><strong><em>In the meantime</em></strong> - we will review your selection over the subject of
                        <?php echo $selectSubject;?> and any comments.
                    </p>
                    <p>We will get back to you as soon as possible!</p>
                    <p>Thank you for your support.</p>
                    <hr>
                    <div class="bottom">
                        <h4>Recipe City</h4>
                        <p><a href="contact.php">Return to form</a></p>
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