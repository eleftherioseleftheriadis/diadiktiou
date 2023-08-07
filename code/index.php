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
    <a href="help.php" class="help-link">Help</a>
    <a href="askaquestion.php" class="ask-link">Ask a Question</a>
    <?php
    session_start();
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        echo '<a href="user_page.php" class="profile-link">Profile</a>';
        echo '<form method="POST" style="display: inline;">
                <button type="submit" name="logout">Log out</button>
              </form>';
    } else {
        echo '<a href="register.php" class="ask-link">Register</a> ';
        echo '<a href="login.php" class="ask-link">Log in</a>';
    }
    
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
    ?>
  </header>
  <main>
    <section class="accordion">
      <h2>Purpose of the Wacky Website</h2>
      <div class="content">
        <p>Our website is a fun and quirky platform where you can ask all your weird, wacky, and wonderful questions! Whether it's about the meaning of life, the universe, or just your favorite pizza toppings, feel free to ask away! Our community of eccentric minds will provide you with equally bizarre answers!</p>
      </div>
    </section>

    <section class="accordion">
      <h2>How to Register</h2>
      <div class="content">
        <p>To register and join our zany community, follow the steps below:</p>
		  <a href="register.php" class="ask-link">Register</a>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2023 - Wacky Website</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
