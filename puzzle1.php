<?php
session_start();

if (!isset($_SESSION['currentLevel'])) {
    $_SESSION['currentLevel'] = 1;
}
if (!isset($_SESSION['hintsUsed'])) {
    $_SESSION['hintsUsed'] = 0;
}

$correctAnswer = 'echo';
$feedback = '';
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $answer = strtolower(trim($_POST['answer']));
    
    if ($answer === $correctAnswer) {
        $_SESSION['currentLevel'] = 2;
        $success = true;
        header("refresh:2;url=puzzle2.php"); // Redirect after 2 sec
    } else {
        $feedback = "Try Again!";
    }

    if (isset($_POST['use_hint'])) {
        $_SESSION['hintsUsed'] += 1;
        $feedback = "Hint: I am a reflection of sound.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Puzzle 1 - PHP Vault</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container <?= $feedback && !$success ? 'shake' : '' ?>">
    <h1>Puzzle 1</h1>
    <p>I speak without a mouth and hear without ears. What am I?</p>

    <form method="POST" action="">
      <input type="text" name="answer" placeholder="Enter your answer" required />
      <button type="submit" name="submit">Submit</button>
    </form>

    <form method="POST" action="">
      <button type="submit" name="use_hint" class="hint-btn">Get Hint</button>
    </form>

    <?php if ($feedback): ?>
      <p class="feedback"><?= htmlspecialchars($feedback) ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="success-msg">Correct! Proceeding to next level...</div>
    <?php endif; ?>
  </div>
</body>
</html>
