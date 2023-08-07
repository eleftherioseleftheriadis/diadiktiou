<?php
session_start(); // Resume the session

// Check if the user is not logged in and redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Display user-specific content
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- ... (head content) ... -->
</head>
<body>
  <header>
    <!-- ... (header content) ... -->
  </header>
  <main>
    <section class="user-welcome">
      <h2>Welcome to the User Page, <?php echo $username; ?>!</h2>
      <p>This is the content of the user page.</p>
    </section>
  </main>
  <footer>
    <!-- ... (footer content) ... -->
  </footer>
</body>
</html>
