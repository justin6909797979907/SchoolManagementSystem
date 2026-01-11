<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <title>Login Page</title>
</head>
<body>
    <div class="login-container">
        <div class="login-contents">
            <div class="school-logo">
                <img src="assets/bcp-logo.png" alt="School Logo">
            </div>
            <form action="login.php" method="POST">
                    <div class="input-group">
                        <label for="username">User ID *</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="input-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="input-group">
                        <label for="role">User Role *</label>
                        <select id="role" name="role" required>
                            <option value="default">Select role</option>
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <div class="forgot">Forgotten User ID or Password</div>
                    <button type="submit">Login</button>
                </form>
        </div>
    </div>
</body>
</html>
