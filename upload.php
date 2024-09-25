<?php
include 'db.php';

$title = $_POST['title'];
$description = $_POST['description'];
$location = $_POST['location'];
$image = $_FILES['image']['name'];
$target = "uploads/" . basename($image);

if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
}

if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    $sql = "INSERT INTO images (title, description, location, image_path) VALUES ('$title', '$description', '$location', '$target')";
    if ($conn->query($sql) === TRUE) {
        echo "Image uploaded successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Failed to upload image.";
}

$conn->close();
?>
