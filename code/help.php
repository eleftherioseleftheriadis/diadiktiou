<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Help</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Wacky Website - Help</h1>
    <button class="theme-toggle">Toggle Theme</button>
    <a href="index.php" class="index-link">Home</a>
    <?php
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
      echo '<a href="user_page.php" class="profile-link">Profile</a> ';
      echo '<a href="all_questions.php" class="profile-link">View Wisdom</a> ';
      echo '<a href="askaquestion.php" class="profile-link">Ask a Question</a> ';
      echo '<a href="answer_question.php" class="profile-link">Wisdom</a> ';
      echo '<form method="POST" style="display: inline;">
              <button type="submit" name="logout">Log out</button>
            </form>';
  } else {
      echo '<a href="register.php" class="ask-link">Register</a>';
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
      <h2>How to Use the Wacky Website</h2>
      <div class="content">
        <p>Our website provides the following functionalities, so brace yourself for some wacky experiences:</p>
        <ul>
          <li><strong>Ask a Question:</strong> Click on the "Ask a Question" link to enter the realm of absurdity! Post your bizarre questions and receive equally wacky answers from our community of eccentric minds.</li>
          <li><strong>Register:</strong> If you want to join our peculiar community, click on the "Register" link. Be prepared to answer a special wacky question that only true enthusiasts can answer correctly!</li>
          <li><strong>Help:</strong> If you're ever lost in the wackiness of our website, don't fret! Click on the "Help" link to find some quirky guidance to navigate through this realm of absurdity.</li>
        </ul>
      </div>
    </section>
  </main>

  <footer>
    <p>© 2023 - Wacky Website</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
