<?php
include 'Database.php';
include 'User.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// Process GET request to delete a user
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Validate the 'matric' parameter
    if (isset($_GET['matric']) && !empty(trim($_GET['matric']))) {
        $matric = trim($_GET['matric']);

        // Initialize database and user objects
        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);

        // Attempt to delete the user
        try {
            if ($user->deleteUser($matric)) {
                $_SESSION['message'] = "User with matric '$matric' has been successfully deleted.";
            } else {
                $_SESSION['message'] = "User with matric '$matric' could not be found or deleted.";
            }
        } catch (Exception $e) {
            error_log("Error deleting user: " . $e->getMessage());
            $_SESSION['message'] = "An error occurred while deleting the user. Please try again.";
        }

        
        header('Location: read.php'); 
        exit();
    } else {
        $_SESSION['message'] = "Invalid or missing 'matric' parameter.";
        header('Location: read.php'); 
        exit();
    }
}
