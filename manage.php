<?php
session_start();

// Hardcoded credentials
$admin_username = 'admin';
$admin_password = 'password123';

// Check if the user is trying to log in
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['loggedin'] = true;
    } else {
        $error = "Invalid username or password";
    }
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="resources/css/gallery.css">
    </head>
    <body>
        <h1>Admin Login</h1>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            <input type="submit" value="Login">
        </form>
        <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="resources/css/gallery.css">
</head>
<body>
    <h1>Upload Image</h1>
    <form action="./upload.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea><br>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location"><br>
        <label for="image">Select image:</label>
        <input type="file" name="image" id="image" required><br>
        <input type="submit" value="Upload">
    </form>

    <h2>Uploaded Images</h2>
    <div class="gallery">
        <?php
        include 'db.php';
        $sql = "SELECT * FROM images";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='gallery-item'>";
                echo "<img src='" . $row['image_path'] . "' alt='" . $row['title'] . "'>";
                echo "<h2>" . $row['title'] . "</h2>";
                echo "<p>" . $row['description'] . "</p>";
                echo "<p><strong>Location:</strong> " . $row['location'] . "</p>";
                echo "<form action='delete.php' method='post' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";
                echo "<form action='edit.php' method='get' style='display:inline;'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='submit' value='Edit'>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }

        $conn->close();
        ?>
    </div>
    <a href="logout.php">Logout</a>
</body>
</html>
