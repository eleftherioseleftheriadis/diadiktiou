<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once('config.php');
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['edit_profile'])) {
        // Process and update user profile data in the database
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];

        // Update the user's information in the database
        $updateQuery = "UPDATE users SET name = '$name', surname = '$surname', email = '$email' WHERE username = '$username'";
        if ($conn->query($updateQuery) === TRUE) {
            $successMessage = "Profile updated successfully!";
            
            // Fetch the latest user data after the update
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $query);
            $userData = mysqli_fetch_assoc($result);
        } else {
            $errorMessage = "Error updating profile: " . $conn->error;
        }
        
        // Check if the password field is not empty before updating
        if (!empty($_POST['new_password'])) {
            $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            $updatePasswordQuery = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
            mysqli_query($conn, $updatePasswordQuery);
        }
    } elseif (isset($_POST['delete_profile'])) {
        // Replace mandatory fields with random words and keep the record in the database
        $randomWord = uniqid(); // Generate a random word
        $updateQuery = "UPDATE users SET name = '$randomWord', surname = '$randomWord', email = '$randomWord', password = '$randomWord' WHERE username = '$username'";
        mysqli_query($conn, $updateQuery);

        // Logout the user and redirect to the login page
        session_destroy();
        header("Location: login.php");
        exit();
    } elseif (isset($_POST['logout'])) {
        // Logout the user and redirect to the login page
        session_destroy();
        header("Location: login.php");
        exit();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Profile</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Welcome to the Wacky Website!</h1>
    <button class="theme-toggle">Toggle Theme</button>
    <a href="help.php" class="help-link">Help</a>
    <a href="askaquestion.php" class="ask-link">Ask a Question</a>
    <form method="POST" style="display: inline;">
      <button type="submit" name="logout">Log out</button>
    </form>
  </header>
  <main>
    <section class="profile-section">
      <h2>Your Profile</h2>
      <form method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $userData['name']; ?>" required>

        <label for="surname">Surname</label>
        <input type="text" id="surname" name="surname" value="<?php echo $userData['surname']; ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo $userData['email']; ?>" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo $userData['username']; ?>" disabled>

        <label for="new_password">New Password</label>
        <input type="password" id="new_password" name="new_password">

        <button type="submit" name="edit_profile">Edit Profile</button>
        <button type="submit" name="delete_profile">Delete Profile</button>
      </form>
      <?php
      if (isset($successMessage)) {
          echo '<p class="success">' . $successMessage . '</p>';
      } elseif (isset($errorMessage)) {
          echo '<p class="error">' . $errorMessage . '</p>';
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
