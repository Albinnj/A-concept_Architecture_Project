<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gallery</title>
    <link rel="stylesheet" href="resources/css/gallery.css">
</head>
<body>
    <header>
        <nav class="navigation">
            <div class="logo">
                <a href="index.html#home">
                    <span class="bold">a-concept</span>
                    <span class="light1">architecture</span>
                    <span class="light2">studio</span>
                </a>
            </div>
            <ul>
                <li><a href="index.html">home</a></li>
                <li><a href="index.html#about">about</a></li>
                <li><a href="index.html#team">team</a></li>
                <li><a href="index.html#work">project</a></li>
                <li><a href="index.html#interior-office">contact</a></li>
                <li><a href="login.php" class="login-button">login</a></li>
            </ul>
        </nav>
        <div class="menu-button">
            <i class="fas fa-bars fa-2x"></i>
        </div>
        <div class="close-button">
            <i class="fas fa-times fa-2x"></i>
        </div>
    </header>

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
                echo "</div>";
            }
        } else {
            echo "No images found.";
        }

        $conn->close();
        ?>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('.menu-button');
    const closeButton = document.querySelector('.close-button');
    const navMenu = document.querySelector('header .navigation ul');

    menuButton.addEventListener('click', function() {
        navMenu.classList.add('open');
        navMenu.classList.remove('close');
        menuButton.style.display = 'none';
        closeButton.style.display = 'block';
    });

    closeButton.addEventListener('click', function() {
        navMenu.classList.add('close');
        navMenu.classList.remove('open');
        closeButton.style.display = 'none';
        menuButton.style.display = 'block';
    });
});
</script>

</body>
</html>
