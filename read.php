<?php
session_start();

include 'Database.php';
include 'User.php';

// Redirect to login if not logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

// Fetch users
$result = $user->getUsers();

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="user-list-container">
        <h1>User List</h1>
        <table border="1" class="user-table">
            <thead>
                <tr>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["matric"]); ?></td>
                            <td><?php echo htmlspecialchars($row["name"]); ?></td>
                            <td><?php echo htmlspecialchars($row["role"]); ?></td>
                            <td><a href="update_form.php?matric=<?php echo urlencode($row["matric"]); ?>">Update</a></td>
                            <td><a href="delete.php?matric=<?php echo urlencode($row["matric"]); ?>" 
                                   onclick="return confirm('Are you sure you want to delete this user?');">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>

</html>
