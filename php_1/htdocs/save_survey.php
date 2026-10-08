<?php
// save_survey.php
// This file runs on the server when someone submits the form.
// It connects to MAMP's MySQL database and saves the answers into a table.

// 1) Connect to MAMP's MySQL
//    These are MAMP's DEFAULT settings. If MAMP's "MySQL Port" (in
//    MAMP > Preferences > Ports) is different on your machine, change $port.
$host    = "localhost";
$port    = 8889;        // MAMP default MySQL port
$db_user = "root";      // MAMP default username
$db_pass = "root";      // MAMP default password
$db_name = "dae_survey";

$conn = new mysqli($host, $db_user, $db_pass, $db_name, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error .
        " (double check MAMP is running and the port above matches yours)");
}

// 2) Read the fields that were submitted from the form
//    The ?? '' means "if it's missing, just use an empty string" so this
//    doesn't crash if a field is left blank.
$fname   = $_POST['fname']   ?? '';
$lname   = $_POST['lname']   ?? '';
$ctrack  = $_POST['ctrack']  ?? '';
$lfuture = $_POST['lfuture'] ?? '';
$vphone  = $_POST['vphone']  ?? '';

// 3) Save it to the database.
//    We use a "prepared statement" (prepare + bind_param) instead of just
//    pasting the values into the SQL text. This is the standard, safe way
//    to insert user-submitted data — it prevents a trick called SQL
//    injection where someone could type SQL code into a form field.
$stmt = $conn->prepare(
    "INSERT INTO post_class_survey (fname, lname, ctrack, lfuture, vphone)
     VALUES (?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssss", $fname, $lname, $ctrack, $lfuture, $vphone);
$stmt->execute();

// 4) Show a simple confirmation page
echo "<h2>Thanks" . ($fname ? ", " . htmlspecialchars($fname) : "") . "! Your survey was saved.</h2>";
echo '<p><a href="index.html">Back to form</a></p>';

$stmt->close();
$conn->close();
