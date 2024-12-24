<?php
session_start();

include 'Database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    $database = new Database();
    $db = $database->getConnection();

    $matric = trim($db->real_escape_string($_POST['matric']));
    $password = trim($db->real_escape_string($_POST['password']));

    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if userDetails is valid and return as an array
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            session_regenerate_id(true);
            $_SESSION['loggedin'] = true;
            $_SESSION['matric'] = $userDetails['matric'];
            $_SESSION['name'] = $userDetails['name'];
            $_SESSION['role'] = $userDetails['role'];

            if ($userDetails['role'] === 'admin') {
                header('Location: read.php');
            } else {
                header('Location: read.php');
            }
            exit();
        } else {
            $error = 'Invalid username or password.';
            header('Location: login.php?error=' . urlencode($error));
            exit();
        }
    } else {
        $error = 'Please fill in all required fields.';
        header('Location: login.php?error=' . urlencode($error));
        exit();
    }
}
?>
