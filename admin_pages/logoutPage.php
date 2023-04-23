<?php
    session_start();        // access existing session
    // close the session
    session_unset();
    session_destroy();
    // close the database
    $conn = null;
    // redirect to the application homepage/login page
    header("Location: loginPage.php");
?>