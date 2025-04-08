<?php
session_start();

// Calculate total time
$final_time = "00:00";
if (isset($_SESSION['start_time'])) {
    $elapsed = time() - $_SESSION['start_time'];
    $minutes = floor($elapsed / 60);
    $seconds = $elapsed % 60;
    $final_time = sprintf("%02d:%02d", $minutes, $seconds);
}

// Pull game stats
$puzzlesSolved = $_SESSION['puzzles_completed'] ?? 0;
$hintsUsed = $_SESSION['hintsUsed'] ?? 0;

// Score calculation (basic logic — adjust as needed)
$score = 100;
$score -= $hintsUsed * 5;   // -5 points per hint
$score = max(0, $score);    // Prevent negative scores

// End session after grabbing data
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Escape Room Results</title>
    <link rel="stylesheet" href="css/results.css">
</head>
<body>
    <div class="results-container">
        <h1>🎉 You Escaped!</h1>
        <p><strong>Time Taken:</strong> <?php echo $final_time; ?></p>
        <p><strong>Puzzles Solved:</strong> <?php echo $puzzlesSolved; ?></p>
        <p><strong>Hints Used:</strong> <?php echo $hintsUsed; ?></p>
        <p><strong>Final Score:</strong> <?php echo $score; ?></p>

        <a href="index.php" class="btn">🔄 Play Again</a>
    </div>
</body>
</html>


