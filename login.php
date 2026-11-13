<?php
session_start();

// 1. Database Connection
$servername = "localhost";
$username = "webuser";
$password = "kali"; // Your MariaDB password
$dbname = "CAT2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Look up the user in the database
    $sql = "SELECT id, fullname, password FROM users WHERE username = '$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $user;
            $_SESSION['fullname'] = $row['fullname'];
            header("Location: dashboard.php"); // Redirect to dashboard on success
            exit();
        } else {
            $message = "<p style='color:red;'>Invalid password!</p>";
        }
    } else {
        $message = "<p style='color:red;'>No user found with that username!</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px; }
        h2 { text-align: center; color: #333; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome Back</h2>
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <label>Username</label>
            <input type="text" name="username" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <button type="submit">Sign In</button>
        </form>
        
        <p style="text-align: center; margin-top: 15px;">Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</body>
</html>
