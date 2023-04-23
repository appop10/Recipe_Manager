<?php
    session_start();
    
    $errMsg = "";
    $validUser = false;

    if(isset($_POST["submit"])) {
        $inUsername = $_POST["username"];
        $inPassword = $_POST["password"];

        require 'databases/dbConnect.php';

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT event_username, event_password FROM wdv341_events_users WHERE event_username = :username and event_password = :password";

        $stmt = $conn->prepare("$sql");

        $stmt->bindParam(':username', $inUsername);
        $stmt->bindParam(':password', $inPassword);

        $stmt->execute();

        // process the result: did the select find a matching record?
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();

        if($row) {
            $validUser = true;
            $_SESSION['validUser'] = true;      // create a session variable and assign a value
            $_SESSION['username'] = $inUsername;
            // display welcome message
            // display admin side
            // not display the form
        } else {
            // display error message
            $errMsg = "Invalid username or password";
            // display the form
        }

    } else {
        // display form
        // if validUser is true, display admin - set the validate to true
        if(isset($_SESSION['validUser'])) {
            $validUser = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Login</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="stylesheets/login.css">
</head>
<body>

<?php
    if($validUser) {
        // display admin area
?>
    <nav>
        <p><a href="loginPage.php">Admin Area</a></p>

        <ul>
            <li><a href="addRecipe.php">Add Recipe</a></li>
            <li><a href="#">View All Recipes</a></li>
            <li><a href="logoutPage.php">Sign out</a></li>
        </ul>
    </nav>

    <main>
        <header>
            <h1>Welcome to the Admin System</h1>
            <h2>You are signed on as <?php echo $_SESSION['username']; ?></h2>
        </header>

        <div>
            <img src="mobile-banking.png" alt="mobline banking icon">
        </div>
    </main>
<?php
    } else {
        // dipslay the form
?>
    <div class="container"><!-- container div -->
        <h1>Event Login System</h1>

        <form method="post" action="loginPage.php">
            <h2>Sign In</h2>

            <p class="error-message"><?php echo $errMsg; ?></p>

            <div>
                <p>
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" placeholder="Username">
                </p>

                <p>
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">

                </p>

                <p>
                    <input type="submit" name="submit" id="submit" value="Sign In">
                    <input type="reset" name="reset" id="reset" value="Clear">
                </p>
            </div>
        </form>
    </div><!-- close container -->
<?php
    }
?>
    
</body>
</html>