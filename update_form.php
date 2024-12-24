<?php
include 'Database.php';
include 'User.php';

session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $matric = htmlspecialchars($_GET['matric']); 

    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    $db->close();
    if (!$userDetails) {
        echo "<p>User not found. <a href='read.php'>Go back</a></p>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Update User</h1>
    <form action="update.php" method="post" class="update-form">
        <div class="form-group">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($userDetails['matric']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userDetails['name']); ?>" required aria-required="true">
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" required aria-required="true">
                <option value="">Please select</option>
                <option value="lecturer" <?php echo $userDetails['role'] === 'lecturer' ? 'selected' : ''; ?>>Lecturer</option>
                <option value="student" <?php echo $userDetails['role'] === 'student' ? 'selected' : ''; ?>>Student</option>
            </select>
        </div>
        <div class="form-actions">
            <input type="submit" value="Update" class="btn-submit">
            <a href="read.php" class="btn-cancel">Cancel</a>
        </div>
    </form>
</body>

</html>
<?php
}
?>
