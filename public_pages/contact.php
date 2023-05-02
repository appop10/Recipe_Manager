<?php
// make a Date Object to put in the footer
$currentDate = date('m-d-Y');

// flag variables
$formSubmitted = false;
$formValid = false;
// value variables
$firstName = "";
$lastName = "";
$emailAddress = "";
$confirmEmail = "";
$messageSubject = "";
$messageText = "";
// error message variables
$firstNameError = "";
$lastNameError = "";
$emailAddressError = "";
$confirmEmailError = "";
$messageSubjectError = "";
$messageTextError = "";

// clean up form field
function cleanField($inFieldName)
{
    $inFieldName = trim($inFieldName);  // remove extra space, tab, newline
    $inFieldName = stripslashes($inFieldName);  // remove backslashes
    $inFieldName = htmlspecialchars($inFieldName);  // replace any special characters with HTML
    return $inFieldName;
}
// validate form field
function validateField($inFieldName)
{
    $specialChars = ['#', '$', '%', '^', '&', '*', '+', '<', '>'];
    $specialCharsCount = 0;
    $validField = false;

    // if inFieldName has any characters in the array
    for ($x = 0; $x < count($specialChars); $x++) {
        if (strpos($inFieldName, $specialChars[$x])) {
            $specialCharsCount++;
        }
    }

    if ($specialCharsCount == 0) {
        $validField = true;
    }

    return $validField;
}
// check if form submitted
if (isset($_POST['submit'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAddress = $_POST['emailAddress'];
    $confirmEmail = $_POST['confirmEmail'];
    $messageSubject = $_POST['messageSubject'];
    $messageText = $_POST['messageText'];

    // validate firstName
    $firstName = cleanField($firstName);
    $validFirstName = validateField($firstName);

    if (!$validFirstName) {
        $firstNameError = "First name may not contain special characters";
    }
    
    // validate lastName
    $lastName = cleanField($lastName);
    $validLastName = validateField($lastName);

    if (!$validLastName) {
        $lastNameError = "Last name may not contain special characters";
    }

    // validate emailAddress
    $validEmailAddress = filter_var($emailAddress, FILTER_VALIDATE_EMAIL);

    if (!$validEmailAddress) {
        $emailAddressError = "Please enter a valid email address";
    }

    // validate confirmEmail
    if (!($confirmEmail === $emailAddress)) {
        $confirmEmailError = "Email must be the same";
    }
    
    // validate messageSubject
    $messageSubject = cleanField($messageSubject);
    $validMessageSubject = validateField($messageSubject);

    if (!$validMessageSubject) {
        $messageSubjectError = "Message subject may not contain special characters";
    }

    // validate messageText
    $validMessageText = false;

    if (empty($messageText)) {
        $messageTextError = "Please enter a message";
    } else {
        $messageText = cleanField($messageText);
        $validMessageText = validateField($messageText);
    }

    // load valid variables into array to  see if all fields pass
    $validFields = [$validFirstName, $validLastName, $validEmailAddress, $validMessageSubject, $validMessageText];
    $invalidCount = 0;

    for ($x=0; $x < count($validFields); $x++) {
        if (!$validFields[$x]) {
            $invalidCount++;
        }
    }

    // check if form is valid 
    if ($invalidCount == 0) {
        $formValid = true;
    }

    if ($formValid) {
        if (empty($_POST['phoneNumber'])) {
            $formSubmitted = true;
        } else {
            exit("Form Invalid");
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
    <meta name="description" content="Contact page for All Things Pasta">
    <title>ATP | Contact</title>

    <link rel="stylesheet" href="stylesheets/contact/contact.css">
    <link rel="stylesheet" href="stylesheets/contact/contact_mq.css">

    <script src="javascript/main.js"></script>
</head>

<body>
    <?php
    if (!$formSubmitted) {
    ?>
        <nav class="transforming"><!-- Navbar -->
            <div>
                <a href="home.html"><img src="../images/logo_white.png" alt="all things pasta logo"></a>

                <div class="hamburger" onclick="dropMenu()">
                    <p id="bar1"></p>
                    <p id="bar2"></p>
                    <p id="bar3"></p>
                </div>
            </div>

            <ul>
                <li><a href="recipes.php">Recipes</a></li>
                <li><a>About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a class="signin" href="../admin_pages/loginPage.php">Sign In</a></li>
            </ul>
        </nav><!-- Navbar -->

        <header><!-- Header -->
            <h1>I Apprecite Your Feedback</h1>
            <p>I would love to hear from you about any and all things related to pasta! Recipes you want to see, improvements to ones you've already seen, or questions you have about the ones already posted, I'm excited to hear from you.</p>
        </header><!-- Header -->

        <main><!-- Form -->
            <div class="form-container"><!-- form container -->
                <form method="post" action="contact.php"><!-- form body -->
                    <legend>Send Me A Message</legend>

                    <div>
                        <p>
                            <label for="firstName">First Name</label>
                            <span class="errMsg"><?php echo $firstNameError; ?></span>
                            <input type="text" name="firstName" id="firstName" placeholder="Jane" required value="<?php echo $firstName; ?>">
                        </p>

                        <p>
                            <label for="lastName">Last Name</label>
                            <span class="errMsg"><?php echo $lastNameError; ?></span>
                            <input type="text" name="lastName" id="lastName" placeholder="Doe" required value="<?php echo $lastName; ?>">
                        </p>
                    </div>

                    <div>
                        <p>
                            <label for="emailAddress">Email</label>
                            <span class="errMsg"><?php echo $emailAddressError; ?></span>
                            <input type="email" name="emailAddress" id="emailAddress" placeholder="janedoe@email.com" required value="<?php echo $emailAddress; ?>">
                        </p>

                        <p>
                            <label for="confirmEmail">Confirm Email</label>
                            <span class="errMsg"><?php echo $confirmEmailError; ?></span>
                            <input type="email" name="confirmEmail" id="confirmEmail" required value="<?php echo $confirmEmail; ?>">
                        </p>
                    </div>

                    <div>
                        <p>
                            <label for="messageSubject">Subject</label>
                            <span class="errMsg"><?php echo $messageSubjectError; ?></span>
                            <input type="text" name="messageSubject" id="messageSubject" placeholder="Recipe Suggestion" required value="<?php echo $messageSubject; ?>">
                        </p>

                        <p>
                            <label for="phoneNumber">Phone Number</label>
                            <span class="errMsg"></span>
                            <input type="tel" name="phoneNumber" id="phoneNumber">
                        </p>
                    </div>

                    <div>
                        <p>
                            <label for="messageText">Message</label>
                            <span class="errMsg"><?php echo $messageTextError; ?></span>
                            <textarea name="messageText" id="messageText" rows="5" value="<?php echo $messageText; ?>"></textarea>
                        </p>
                    </div>

                    <div>
                        <input type="submit" name="submit" id="submit" value="Send" onclick="scrollToForm()">
                        <input type="reset" name="reset" id="reset" value="Clear">
                    </div>
                </form><!-- form body -->
            </div><!-- form container -->
        </main><!-- Form -->

        <footer><!-- Footer -->
            <section>
                <a href="#"><img src="../images/logo_white.png" alt="all things pasta logo"></a>

                <div><!-- Browse -->
                    <h3>Browse</h3>
                    <p><a>All Recipes</a></p>
                    <p><a>Recipes by Category</a></p>
                    <p><a>Recipes by Ingredient</a></p>
                </div><!-- Browse -->

                <div><!-- Shop -->
                    <h3>Shop</h3>
                    <p><a>My Cookbook</a></p>
                    <p><a>Cookware</a></p>
                    <p><a>Merchandise</a></p>
                </div><!-- Shop -->

                <div><!-- Connect -->
                    <h3>Connect</h3>
                    <p><a>About</a></p>
                    <p><a>Contact</a></p>
                </div><!-- Connect -->
            </section>

            <div>
                <p>Photo and Recipe Credits</p>
                <a href="credits/credits.html" target="_blank" class="signin">View</a>
                <span>&copy; <?php echo $currentDate; ?></span>
            </div>
        </footer><!-- Footer -->
    <?php
    } else {
    ?>
        <main><!-- Confirmation -->
            <div class="form-container"><!-- form container -->
                <div class="confirm-container"><!-- Confirm Message -->
                    <h2>Thanks for reaching out, <?php echo $firstName; ?>!</h2>
                    <p>I've received the message below: </p>

                    <div>
                        <p>Subject: </p>
                        <span><?php echo $messageSubject; ?></span>
                    </div>

                    <div>
                        <p>Message: </p>
                        <span>
                            <?php echo $messageText; ?>
                            <br>Sincerely,
                            <br><?php echo $firstName . " " . $lastName; ?>
                        </span>
                    </div>

                    <p>I'll email you back at <?php echo $emailAddress; ?> as soon as I can. Have a good one!</p>

                    <a href="home.html">Back to Homepage</a>
                </div><!-- Confirm Message -->
            </div><!-- form container -->
        </main><!-- Confirmation -->
    <?php
    }
    ?>
</body>

</html>