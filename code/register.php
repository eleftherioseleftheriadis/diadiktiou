<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ask a Question</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Ask a Wacky Question!</h1>
    <button class="theme-toggle">Toggle Theme</button>
    <a href="index.php" class="index-link">Back to Home</a>
    <a href="help.php" class="help-link">Help</a>
  </header>
  <main>
    <!-- Here you can include the HTML form for asking questions -->
    <form action="submit_question.php" method="post">
      <label>Your Wacky Question: <input type="text" name="question" required></label><br>
      <input type="submit" value="Ask the Unthinkable!">
    </form>
    <!-- End of the HTML form for asking questions -->
  </main>

  <footer>
    <p>© 2023 - Wacky Website</p>
  </footer>

  <script src="script.js"></script>
</body>
</html>
