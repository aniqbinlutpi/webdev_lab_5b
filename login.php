<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="login-container">
        <h1>Login Page</h1>

        <?php
        // Check if registration was successful and show a message
        if (isset($_GET['registered']) && $_GET['registered'] == 'true') {
            echo '<p class="success-message">Registration successful! Please log in.</p>';
        }

        // Check for any error messages
        if (isset($_GET['error'])) {
            echo '<p class="error-message">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>

        <form action="authenticate.php" method="post" novalidate>
            <div class="form-group">
                <label for="matric">Matric:</label>
                <input type="text" name="matric" id="matric" required 
                    pattern="[A-Za-z0-9]{4,}" 
                    title="Matric should be at least 4 alphanumeric characters." />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required autocomplete="off" />
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit" class="btn-submit">
            </div>
        </form>
        <p>
            <a href="register_form.php" class="register-link">Register here</a> if you have not.
        </p>
    </main>
</body>

</html>
