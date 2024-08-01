<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Reporting System</title>
</head>
<body>
    <div>
        <h1>Crime Reporting System</h1>
        <h2>Sign Up</h2>
        <form method="post" action="signup_process.php">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Sign Up</button>
        </form>

        <h2>Sign In</h2>
        <form method="post" action="login_process.php">
            <label for="signin_email">Email:</label>
            <input type="email" id="signin_email" name="email" required><br><br>

            <label for="signin_password">Password:</label>
            <input type="password" id="signin_password" name="password" required><br><br>

            <button type="submit">Sign In</button>
        </form>
    </div>
</body>
</html>
