<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Welcome to the Wacky Website!</h1>
    <button class="theme-toggle">Toggle Theme</button>
    <a href="index.php" class="index-link">Home</a>
    <a href="help.php" class="help-link">Help</a>
    <a href="askaquestion.php" class="ask-link">Ask a Question</a>
	<a href="register.php" class="ask-link">Register</a>
  <a href="login.php" class="ask-link">Login</a>
  </header>
  <main>
      <h2>Register</h2>
      <div class="content">
        <p>To register and join our zany community, fill out the form below:</p>
        <form method="post" action="register_process.php">
          Name: <input type="text" name="name"><br>
          Surname: <input type="text" name="surname"><br>
          Username: <input type="text" name="username"><br>
          Password: <input type="password" name="password"><br>
          Email: <input type="text" name="email"><br>
          Simplepush.io Key: <input type="text" name="simplepush_key"><br>
          <input type="submit" name="submit" value="Sign Up">
        </form>
      </div>

  </main>

  <footer>
    <p>© 2023 - Wacky Website</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
