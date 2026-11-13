<?php
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e9ecef; margin: 0; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .header h1 { margin: 0; color: #333; }
        .logout { color: red; text-decoration: none; font-weight: bold; }
        .content { margin-top: 20px; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
    <div class="header">
        <h1>Student Portal</h1>
        <div>
            Welcome, <strong><?php echo $_SESSION['fullname']; ?></strong>! 
            <a href="logout.php" class="logout">Logout</a>
        </div>
    </div>

    <div class="content">
        <h2>Dashboard</h2>
        <p>You have successfully logged in! This is where you can add the custom form required for Part B Question 7.</p>
        
        <!-- You can add your custom form here later -->
    </div>
</body>
</html>
