<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
    <section class="login-form">
      <h2>Login</h2>
      <form action="login_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
      </form>
    </section>
  </main>
  <footer>
    <p>© <?php echo date("Y"); ?> - Wacky Website</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>
