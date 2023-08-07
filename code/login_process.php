<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // You should have a proper authentication mechanism here
    // For demonstration purposes, let's assume the correct username and password are "admin"
    if ($username === "admin" && $password === "admin") {
        // Successful login, redirect the user to user_page.php
        header("Location: user_page.php");
        exit();
    } else {
        // Incorrect login credentials, show an error message
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Process</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Login to the Wacky Website</h1>
    <a href="help.php" class="help-link">Help</a>
    <a href="askaquestion.php" class="ask-link">Ask a Question</a>
    <a href="register.php" class="ask-link">Register</a>
    <a href="login.php" class="ask-link">Log in</a>
  </header>
  <main>
    <section class="login-message">
      <?php if (isset($error_message)) { ?>
        <p class="error"><?php echo $error_message; ?></p>
      <?php } ?>
    </section>
  </main>
  <footer>
    <p>© <?php echo date("Y"); ?> - Wacky Website</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>
