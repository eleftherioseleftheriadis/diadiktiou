<?php
session_start();
require_once('config.php'); // Your database connection configuration

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $title = $_POST["title"];
    $main_text = $_POST["main_text"];

    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $insert_query = "INSERT INTO questions (user_id, title, main_text) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iss", $user_id, $title, $main_text);

    if ($stmt->execute()) {
        $success_message = "Question submitted successfully.";
    } else {
        $error_message = "Error submitting question: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

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
    <a href="all_questions.php" class="ask-link">View Wisdom</a>
    <?php
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        echo '<a href="user_page.php" class="profile-link">Profile</a>';
        echo '<form method="POST" style="display: inline;">
                <button type="submit" name="logout">Log out</button>
              </form>';
    } else {
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
    <section class="question-form">
      <h2>Submit a New Question</h2>
      <form action="askaquestion.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="main_text">Main Text:</label>
        <textarea id="main_text" name="main_text" rows="4" required></textarea>
        <button type="submit">Submit Question</button>
      </form>
      <?php
      if (isset($success_message)) {
          echo '<p class="success">' . $success_message . '</p>';
      } elseif (isset($error_message)) {
          echo '<p class="error">' . $error_message . '</p>';
      }
      ?>
    </section>
  </main>
  <footer>
    <p>© 2023 - Wacky Website</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>
