<?php
if (isset($_GET['q'])) {
  $query = $_GET['q'];
} else {
  header('Location: /'); // Redirect to the home page
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

$sql = "SELECT * FROM `pages` WHERE `title` LIKE '%$query%'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php include "includes/site_head.php" ?>

<body>
  <?php include "includes/header.php" ?>
  <div class="site-main-container">
    <main class="site-main">
      <div class="site-main__content">
        <h1 class="header-1">Results</h1>
        <?php if (isset($_GET['q'])) : ?>
          <h2 class="header-2">
            You have searched
            <span class="site-header__logo"><b><i>The Site</i></b></span> for "<?php echo $_GET['q']; ?>".
          </h2>
        <?php else : ?>
          <h2 class="header-2">Please enter a search query.</h2>
        <?php endif; ?>
        <?php

        ?>
        <?php if (mysqli_num_rows($result) > 0) : ?>
          <h2 href="" class="header-2"><?php echo "We found " . $result->num_rows . " result(s)" ?></h2>
          <ul role="list">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
              <li><?php echo "<a href=\"/page?id=" . $row["id"] . "\" class=\"link\">" . $row["title"] . "</a>" ?></li>
            <?php endwhile; ?>
          </ul>

        <?php else : ?>
          <h2 class="header-2">We found nothing :(</h2>

        <?php endif; ?>
      </div>
      <?php include "includes/warhead_countdown.php" ?>
    </main>

  </div>
  <div class="site-meme-wrapper"></div>
</body>

</html>
<?php
$conn->close();
?>