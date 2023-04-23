<?php
    session_start();

    // flag/switch variable - tells whether or not you requested the form
    $formRequested = true;
    $readyStmt = true;
    $errMsg = "";
    $eventNameMsg = "";
    $eventDescriptionMsg = "";
    $eventPresenterMsg = "";
    $eventDateMsg = "";
    $eventTimeMsg = "";

    // functions to make sure all fields are filled in
    function checkFieldEmpty($inField) {
        if(empty($inField)) {
            $requireddMsg = "*Field is required";
        } else {
            $requireddMsg = "";
        }

        return $requireddMsg;
    }
    function countEmptyFields($inFieldArray) {
        $tally = 0;

        for($x=0; $x<count($inFieldArray); $x++) {
            if($inFieldArray[$x] != "") {
                $tally++;
            }
        }

        return $tally;
    }

    // if invalid user return to loginPage.php
    if(!(isset($_SESSION['validUser']))) {
        header("Location: loginPage.php");
        exit();
    }

    // process the form if submitted
    if (isset($_POST['submit'])) {
        // process the form data into the database
        if(empty($_POST['dateInserted']) && empty($_POST['dateUpdated'])) {
            // variables from form fields
            $eventName = $_POST['eventName'];
            $eventDescription = $_POST['eventDescription'];
            $eventPresenter = $_POST['eventPresenter'];
            $eventDate = $_POST['eventDate'];
            $eventTime = $_POST['eventTime'];

            // date inserted/updated will be a generated date
            $dateInserted = date("Y-m-d");

            $eventNameMsg = checkFieldEmpty($eventName);
            $eventDescriptionMsg = checkFieldEmpty($eventDescription);
            $eventPresenterMsg = checkFieldEmpty($eventPresenter);
            $eventDateMsg = checkFieldEmpty($eventDate);
            $eventTimeMsg = checkFieldEmpty($eventTime);

            $fieldArray = [$eventNameMsg, $eventDescriptionMsg, $eventPresenterMsg, $eventDateMsg, $eventTimeMsg];

            $fieldCount = countEmptyFields($fieldArray);

            if($fieldCount == 0) {
                $formRequested = false;

                try {
                    require "../../databases/dbConnect.php";
                    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                    $sql = "INSERT INTO wdv341_events (name, description, presenter, date, time, date_inserted, date_updated) VALUES (:eventName, :eventDescription, :eventPresenter, :eventDate, :eventTime, :dateInserted, :dateUpdated)";

                    $stmt = $conn->prepare("$sql");
                    $stmt->bindParam(':eventName', $eventName);
                    $stmt->bindParam(':eventDescription', $eventDescription);
                    $stmt->bindParam(':eventPresenter', $eventPresenter);
                    $stmt->bindParam(':eventDate', $eventDate);
                    $stmt->bindParam(':eventTime', $eventTime);
                    $stmt->bindParam(':dateInserted', $dateInserted);
                    $stmt->bindParam(':dateUpdated', $dateInserted);

                    $stmt->execute();
                    $conn = null;
                } catch(PDOException $e) {
                    $readyStmt = false;
                    $errMsg = "Data Unavailable";
                }
            }

        } else {
            exit("Form Invalid");
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self Posting Form</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="stylesheets/enter-event-page.css">
</head>
<body>
    <nav>
        <p><a href="loginPage.php">Admin Area</a></p>

        <ul>
            <li><a href="addRecipe.php">Add Recipe</a></li>
            <li><a href="#">View All Recipes</a></li>
            <li><a href="logoutPage.php">Sign out</a></li>
        </ul>
    </nav>

    <main>
<?php
    if ($formRequested) {
        // form was requested
        // display form
?>
    
    <header>
        <h1>WDV341 Intro to PHP</h1>
        <h2>Self Posting Form - Event Input</h2>
    </header>

    <form method="post" action="unit_11_self_posting_form.php">
        <h3>Event Input Form</h3>

        <p>
            <label for="eventName">Event Name</label>
            <span class="error-message"><?php echo $eventNameMsg; ?></span>
            <input type="text" name="eventName" id="eventName">
        </p>

        <div><!-- description and presenter -->
            <p>
                <label for="eventDescription">Event Description</label>
                <span class="error-message"><?php echo $eventDescriptionMsg; ?></span>
                <input type="text" name="eventDescription" id="eventDescription">
            </p>

            <p>
                <label for="eventPresenter">Event Presenter</label>
                <span class="error-message"><?php echo $eventPresenterMsg; ?></span>
                <input type="text" name="eventPresenter" id="eventPresenter">
            </p>
        </div>

        <div><!-- date and time -->
            <p>
                <label for="eventDate">Event Date</label>
                <span class="error-message"><?php echo $eventDateMsg; ?></span>
                <input type="date" name="eventDate" id="eventDate">
            </p>

            <p>
                <label for="eventTime">Event Time</label>
                <span class="error-message"><?php echo $eventTimeMsg; ?></span>
                <input type="time" name="eventTime" id="eventTime">
            </p>
        </div>

        <div><!-- inserted and updated -->
            <p class="info-dates">
                <label for="dateInserted">Date Inserted</label>
                <span class="error-message"></span>
                <input type="date" name="dateInserted" id="dateInserted">
            </p>

            <p class="info-dates">
                <label for="dateUpdated">Date Updated</label>
                <span class="error-message"></span>
                <input type="date" name="dateUpdated" id="dateUpdated">
            </p>
        </div>

        <div>
            <input type="submit" name="submit" value="Submit">
            <input type="reset" name="reset" value="Reset">
        </div>
    </form>
<?php
    } else {
        // dipslay cofirmation
?>
    <div class="container">
        <h3><?php echo $errMsg; ?></h3>
        <h3>Thank You!</h3>
        <p>Your event has been added to the database. Please check your new event on the Display Events page.</p>
    </div>
<?php
    }
?>
    </main><!-- close main -->
</body>
</html>