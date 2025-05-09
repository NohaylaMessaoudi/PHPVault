<?php
session_start();

// Calculate the timer
if (isset($_SESSION['start_time'])) {
    $elapsed = time() - $_SESSION['start_time'];
    $minutes = floor($elapsed / 60);
    $seconds = $elapsed % 60;
    $formattedTime = sprintf("%02d:%02d", $minutes, $seconds);
} else {
    $formattedTime = "00:00";
}

// Define the word list and hints
$words = ["planet", "castle", "garden", "puzzle", "rocket"];
$hints = [
    "planet" => "A large celestial body that orbits a star.",
    "castle" => "A fortified residence, often medieval.",
    "garden" => "A place to grow flowers and vegetables.",
    "puzzle" => "A game that tests your logic or knowledge.",
    "rocket" => "It launches into space."
];

$message = "";
$feedback = "";
$success = false;
$showForm = true;

// Set a new word if not already selected
if (!isset($_SESSION['original_word'])) {
    $word = $words[array_rand($words)];
    $_SESSION['original_word'] = $word;
    $_SESSION['scrambled_word'] = str_shuffle($word);
} else {
    $word = $_SESSION['original_word'];
}

// Handle guess and hint request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['guess'])) {
        $guess = strtolower(trim($_POST['guess']));
        if ($guess === $word) {
            $message = "🎉 Correct! The word was <strong>{$word}</strong>.";
            $success = true;
            $showForm = false;

            // ✅ Clear only puzzle-specific data, not the whole session
            unset($_SESSION['original_word']);
            unset($_SESSION['scrambled_word']);
        } else {
            $message = "❌ Incorrect. Try again!";
        }
    }

    if (isset($_POST['use_hint'])) {
        $feedback = "💡 Hint: " . $hints[$word];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Anagram Puzzle</title>
    <link rel="stylesheet" href="css/puzzle2.css">
    <link rel="stylesheet" href="css/timer.css">
</head>
<body>
    <!-- Timer Display -->
    <p class="timer">Time Elapsed: <?php echo $formattedTime; ?></p>

    <div class="game-container">
        <h1>🔤 Anagram Puzzle</h1>
        <p>Unscramble this word:</p>
        <div class="scrambled-word"><?php echo $_SESSION['scrambled_word']; ?></div>

        <?php if ($showForm): ?>
            <!-- Guess Form -->
            <form method="post">
                <input type="text" name="guess" placeholder="Your guess..." required>
                <button type="submit">Submit</button>
            </form>

            <!-- Hint Button -->
            <form method="post">
                <button type="submit" name="use_hint" class="hint-btn">Get Hint</button>
            </form>
        <?php endif; ?>

        <!-- Feedback -->
        <?php if (!empty($feedback)): ?>
            <p class="feedback"><?= htmlspecialchars($feedback) ?></p>
        <?php endif; ?>

        <!-- Result Message -->
        <p class="message"><?php echo $message; ?></p>

        <!-- Success and next puzzle -->
        <?php if ($success): ?>
            <div class="success-msg">✅ Correct! Ready for the next puzzle?</div>
            <form action="puzzle3.php" method="get">
                <button type="submit" class="next-puzzle">Go to Next Puzzle</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>


