<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$location = $_POST['location'];
$image = $_FILES['image']['name'];

if ($image) {
    $target = "uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    // Get the old image path
    $sql = "SELECT image_path FROM images WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $old_image_path = $row['image_path'];

    // Delete the old image file from the server
    if (file_exists($old_image_path)) {
        unlink($old_image_path);
    }

    $sql = "UPDATE images SET title='$title', description='$description', location='$location', image_path='$target' WHERE id=$id";
} else {
    $sql = "UPDATE images SET title='$title', description='$description', location='$location' WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Image updated successfully.";
} else {
    echo "Error updating image: " . $conn->error;
}

$conn->close();
header("Location: manage.php");
?>
