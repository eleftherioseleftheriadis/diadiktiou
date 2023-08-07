<?php
session_start();
require_once('config.php'); // Your database connection configuration

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$question_query = "SELECT id, title, created_at FROM questions ORDER BY created_at DESC";
$question_result = $conn->query($question_query);

$questions = array();

if ($question_result->num_rows > 0) {
    while ($row = $question_result->fetch_assoc()) {
        $questions[] = $row;
    }
}

$conn->close();
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
    <a href="answer_question.php" class="ask-link">Wisdom</a>
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
    <section class="question-list">
      <h2>All Questions</h2>
      <ul>
        <?php
        foreach ($questions as $question) {
            echo '<li><a href="view_question.php?id=' . $question['id'] . '">' . $question['title'] . '</a> - ' . $question['created_at'] . '</li>';
        }
        ?>
      </ul>
    </section>
  </main>
  <footer>
    <p>© 2023 - Wacky Website</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>
