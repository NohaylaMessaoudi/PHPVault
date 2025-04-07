<?php
session_start();

// Set the start time if not already set
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time();
}

// Format the elapsed time
$elapsed = time() - $_SESSION['start_time'];
$minutes = floor($elapsed / 60);
$seconds = $elapsed % 60;
$formattedTime = sprintf("%02d:%02d", $minutes, $seconds);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The PHP Vault - Escape Room</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- Vault Image -->
    <img src="images/gold.png" alt="Vault Image" class="vault-image">

    <!-- Game Container -->
    <div class="wrapper">
        <div class="container">
            <h1>The PHP Vault 🔐</h1>
            <div class="instructions">
                In this escape room, you will solve a series of three puzzles to unlock doors and ultimately escape the vault.
                You’ll enter answers into forms—if the answer is correct, the vault door unlocks. If not, the field shakes and you'll be prompted to try again.
                If you need help, use a hint—but hints lower your score. Your progress is saved, and at the end, you'll see your time, hints used, and final score.
            </div>

            <!-- Start New Game -->
            <form action="newgame.php" method="post">
                <button type="submit" class="start-button">
                    <img src="images/lock.gif" alt="Start New Game" class="lock-icon">
                </button>
                <p class="start-text">Start New Game</p>
            </form>

            <!-- Resume Game if session exists -->
            <?php if (isset($_SESSION['level']) && $_SESSION['level'] > 1): ?>
                <form action="puzzle1.php" method="post">
                    <button type="submit" class="start-button">
                        <img src="images/lock.gif" alt="Resume Game" class="lock-icon">
                    </button>
                    <p class="start-text">Resume Game</p>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

