<?php
session_start();
// Reset session when starting game
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP Vault - Escape Room</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Welcome to PHP Vault</h1>
    <p>Escape the vault by solving 3 puzzles. You only escape if all answers are correct!</p>
    <p>Hints are available but limited — each one affects your final score.</p>

    <a href="puzzle1.php">
      <button>Start Game</button>
    </a>
  </div>
</body>
</html>
