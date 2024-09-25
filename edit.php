<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM images WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Image</title>
    <link rel="stylesheet" href="resources/css/gallery.css">
</head>
<body>
    <h1>Edit Image</h1>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $row['title']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea name="description" id="description"><?php echo $row['description']; ?></textarea><br>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="<?php echo $row['location']; ?>"><br>
        <label for="image">Select new image (optional):</label>
        <input type="file" name="image" id="image"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
