<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$id = $_POST['id'];

// Get the image path
$sql = "SELECT image_path FROM images WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$image_path = $row['image_path'];

// Delete the image file from the server
if (file_exists($image_path)) {
    unlink($image_path);
}

// Delete the record from the database
$sql = "DELETE FROM images WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Image deleted successfully.";
} else {
    echo "Error deleting image: " . $conn->error;
}

$conn->close();
header("Location: manage.php");
?>
