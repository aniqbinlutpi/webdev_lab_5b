<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="register-container">
        <h1>Register</h1>
        <form action="insert.php" method="post" class="register-form">
            <div class="form-group">
                <label for="matric">Matric:</label>
                <input type="text" name="matric" id="matric" required 
                    pattern="[A-Za-z0-9]{4,}" 
                    title="Matric should be at least 4 alphanumeric characters." 
                    aria-required="true" />
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required 
                    pattern="[A-Za-z\s]{3,}" 
                    title="Name should be at least 3 characters and contain only letters." 
                    aria-required="true" />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required 
                    minlength="6" 
                    title="Password must be at least 6 characters long." 
                    autocomplete="off" 
                    aria-required="true" />
            </div>
            <div class="form-group">
                <label for="accessLevel">Role:</label>
                <select name="role" id="accessLevel" required aria-required="true">
                    <option value="">Please select</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Register" class="btn-submit">
            </div>
        </form>
    </main>
</body>

</html>
