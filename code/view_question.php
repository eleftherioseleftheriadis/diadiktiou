<?php
session_start();
require_once('config.php'); // Your database connection configuration

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $question_id = $_GET['id'];

    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $question_query = "SELECT id, title, main_text, created_at FROM questions WHERE id = ?";
    $stmt = $conn->prepare($question_query);
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $question_result = $stmt->get_result();

    if ($question_result->num_rows === 1) {
        $question = $question_result->fetch_assoc();

        $answers_query = "SELECT main_text, created_at FROM answers WHERE question_id = ? ORDER BY created_at ASC";
        $stmt = $conn->prepare($answers_query);
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $answers_result = $stmt->get_result();
    } else {
        header("Location: all_questions.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: all_questions.php");
    exit();
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
    <a href="answer_question.php" class="Wisdom">Wisdom</a>
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
    <section class="question-view">
      <h2><?php echo $question['title']; ?></h2>
      <p><?php echo $question['main_text']; ?></p>
      <p><strong>Posted on:</strong> <?php echo $question['created_at']; ?></p>
    </section>

    <section class="answers-list">
      <h2>Answers</h2>
      <ul>
        <?php
        if ($answers_result->num_rows > 0) {
            while ($answer = $answers_result->fetch_assoc()) {
                echo '<li><p>' . $answer['main_text'] . '</p><p><em>Posted on: ' . $answer['created_at'] . '</em></p></li>';
            }
        } else {
            echo '<li>No answers available.</li>';
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
