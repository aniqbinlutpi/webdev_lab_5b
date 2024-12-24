<?php
include 'Database.php';
include 'User.php';

session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data to prevent XSS and ensure they're safe
    $matric = htmlspecialchars($_POST['matric']);
    $name = htmlspecialchars(trim($_POST['name']));
    $role = htmlspecialchars($_POST['role']);

    // Validate the inputs to ensure all required fields are provided
    if (empty($matric) || empty($name) || empty($role)) {
        echo "All fields are required. Please go back and fill out the form.";
        exit();
    }

    // Create a new database connection
    $database = new Database();
    $db = $database->getConnection();

    // Create a new User object
    $user = new User($db);

    // Attempt to update the user
    if ($user->updateUser($matric, $name, $role)) {
        // Redirect to the read.php page after the update is successful
        header('Location: read.php');
        exit();
    } else {
        echo "An error occurred while updating the user. Please try again.";
    }

    // Close the database connection
    $db->close();
}
?>
