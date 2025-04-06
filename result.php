<?php
session_start();

$totalTime = 0;
$startTime = $_SESSION['startTime'] ?? time();
$endTime = time();

if (!isset($_SESSION['startTime'])) {
    $_SESSION['startTime'] = $startTime;
}

$totalTime = $endTime - $startTime;
$hintsUsed = $_SESSION['hintsUsed'] ?? 0;

// Simple score logic
$score = max(100 - ($hintsUsed * 10) - $totalTime / 2, 0); // customizable

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Game Over - PHP Vault</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>🎉 You Escaped!</h1>
    <p><strong>Time Taken:</strong> <?= $totalTime ?> seconds</p>
    <p><strong>Hints Used:</strong> <?= $hintsUsed ?></p>
    <p><strong>Your Score:</strong> <?= round($score) ?>/100</p>

    <a href="index.php">
      <button>Play Again</button>
    </a>
  </div>
</body>
</html>
