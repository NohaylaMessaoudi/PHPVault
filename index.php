<?php
session_start();
session_destroy(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The PHP Vault</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <img src="gold.png" alt="Vault Image" class="vault-image">

    <div class="wrapper">
        <div class="container">
            <h1>The PHP Vault 🔐</h1>
            <div class="instructions">
                In this escape room, You will solve a series of three puzzles to unlock doors and ultimately escape the vault. You’ll enter answers into forms, If the answer is correct, the vault door unlocks. If not, the field shakes and it will prompt you to try again. If you need help, use a hint—but hints lower your score. Your progress is saved and at the end, you'll see your time, hints used, and final score.
            </div>
            <form action="game.php" method="post">
                <button type="submit" class="start-button">
                    <img src="lock.gif" alt="Start Game" class="lock-icon">
                </button>
            </form>
            <div class="start-text">Start Game</div>
        </div>
    </div>
</body>
</html>
