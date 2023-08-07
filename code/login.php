<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require_once('config.php');
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Successful login
            $_SESSION['username'] = $user['username']; 
            $_SESSION['user_id'] = $user['id']; 
            header("Location: user_page.php");
            exit();
        } else {
            $login_error = "Invalid username or password";
        }
    } else {
        $login_error = "User not found";
    }

    $conn->close();
}
?>

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
    <a href="index.php" class="index-link">Home</a>
    <a href="help.php" class="help-link">Help</a>
    <a href="askaquestion.php" class="ask-link">Ask a Question</a>
    <a href="register.php" class="ask-link">Register</a>
  </header>
  <main>
    <section class="login-form">
      <h2>Login</h2>
      <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Login</button>
      </form>
      <?php if (isset($login_error)) echo '<p class="error">' . $login_error . '</p>'; ?>
    </section>
  </main>
  <footer>
    <p>© <?php echo date("Y"); ?> - Wacky Website</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>
