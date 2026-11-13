<?php
$conn = new mysqli("localhost", "webuser", "kali", "CAT2");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $comment = $_POST['comment'];
    
    $sql = "INSERT INTO feedback (student_name, comments) VALUES ('$name', '$comment')";
    if ($conn->query($sql) === TRUE) {
        $message = "<p style='color:green; font-weight:bold;'>Feedback submitted successfully!</p>";
    } else {
        $message = "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Feedback</title>
    <style>
        body { font-family: Arial; background-color: #f4f7f6; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; max-width: 400px; margin: auto; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #007BFF; color: white; padding: 10px; border: none; border-radius: 4px; width: 100%; cursor: pointer; }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submit Feedback</h2>
        <?php echo $message; ?>
        <form method="POST" action="">
            <label>Your Name</label>
            <input type="text" name="name" required>
            
            <label>Comments</label>
            <textarea name="comment" rows="4" required></textarea>
            
            <button type="submit">Submit Feedback</button>
        </form>
        <p style="text-align: center;"><a href="dashboard.php">Back to Dashboard</a></p>
    </div>
</body>
</html>
