<?php
include 'Database.php';
include 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get user input
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // Validate input (you may want to add more validation here)
    if (!empty($matric) && !empty($name) && !empty($password) && !empty($role)) {
        // Create database connection
        $database = new Database();
        $db = $database->getConnection();

        // Create a new User object
        $user = new User($db);

        // Insert user into the database
        $result = $user->createUser($matric, $name, $password, $role);

        // Check if the user was successfully created
        if ($result === true) {
            // Redirect to login page after successful registration
            header('Location: login.php');
            exit();
        } else {
            // Handle errors if user creation fails
            echo "Error: " . $result;
        }

        // Close the database connection
        $db->close();
    } else {
        echo "Please fill in all required fields.";
    }
}
?>
