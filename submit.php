<?php
session_start();
// CSRF token validation
if (!isset($_POST['token']) || $_POST['token'] !== $_SESSION['token']) {
    !hash_equals("Invalid CSRF token.");
}

unset($_SESSION['token']);

// Database configuration details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Retrieve form data
$salutation = $_POST['salutation'];
$first_name = $_POST['name'];
$last_name = $_POST['surname'];
$email = $_POST['email'];
$gender = $_POST['gender'];
$message = $_POST['comment'];

// Trim input
$firstName = trim($_POST['name']);
$lastName  = trim($_POST['surname']);
$email     = trim($_POST['email']);
$message   = trim($_POST['comment']);

// Validate required fields
if (
    empty($firstName) ||
    empty($lastName) ||
    empty($email) ||
    empty($message)
) {
    die("All required fields must be filled.");
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}



// Insert data into the database
$sql = "INSERT INTO contacts (salutation, first_name, last_name, email, gender, message) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $salutation, $first_name, $last_name, $email, $gender, $message);

if ($stmt->execute()) {
     //  Invalidate token ONLY after successful submission
    unset($_SESSION['token']);

    header("Location: success.html");
    exit();
} else {
    header("Location: error.html");
    exit();
}


$stmt->close();
$conn->close();

?>