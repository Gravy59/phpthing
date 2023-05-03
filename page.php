<?php
if (isset($_GET['id'])) {
    $query = $_GET['id'];
} else {
    header('Location: /');
    exit;
}
$servername = "localhost";
$username = "root";
$password = null;
$dbname = "the_site";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM `pages` WHERE `id`=$query";
$result = $conn->query($sql);

if ($result->num_rows < 1) {
    http_response_code(404);
    exit;
} ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/site_head.php'; ?>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="site-main-container">
        <main class="site-main">
            <div class="site-main__content">
                <?php

                $row = $result->fetch_assoc()
                ?>
                <?php if ($result->num_rows > 0) : ?>
                    <h1 class="header-1"><?php echo $row["title"] ?></h1>
                    <p class="prose"><?php echo $row["body"] ?></p>

                <?php endif; ?>

            </div>
            <?php include 'includes/warhead_countdown.php'; ?>
        </main>
        <?php include 'includes/sidebar.php'; ?>
    </div>
    <div class="site-meme-wrapper"></div>
</body>

</html>
<?php $conn->close();
?>