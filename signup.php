<?php
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
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $user = $_POST['username'];
    // Hash the password for security
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO users (fullname, email, username, password) VALUES ('$fullname', '$email', '$user', '$pass')";
    
    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color:green; font-weight:bold;'>Registration successful! You can now <a href='login.php'>Login</a>.</p>";
    } else {
        $message = "<p style='color:red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background-color: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 300px; }
        h2 { text-align: center; color: #333; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Signup</h2>
        <?php echo $message; ?>
        
        <form method="POST" action="">
            <label>Full Name</label>
            <input type="text" name="fullname" required>
            
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Username</label>
            <input type="text" name="username" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <button type="submit">Sign Up</button>
        </form>
        
        <p style="text-align: center; margin-top: 15px;">Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
