<?php
session_start();


if (isset($_SESSION['start_time'])) {
  $elapsed = time() - $_SESSION['start_time'];
  $minutes = floor($elapsed / 60);
  $seconds = $elapsed % 60;
  $formattedTime = sprintf("%02d:%02d", $minutes, $seconds);
} else {
  $formattedTime = "00:00";
}
// Define emoji puzzles and answers
$emoji_puzzles = [
    '🦁👑' => 'Lion King',
    '🕷️🧑' => 'Spider Man',
    '🤥' => 'Pinocchio',
    '🔍🐠' => 'Finding Nemo',
    '🧞‍♂️👳🐒' => 'Aladdin',
    '🤠🚀' => 'Toy Story',
    '🦖🌍' => 'Jurassic World',
    '🚗💨😡' => 'Fast and Furious',
];

// Function to reset the puzzle
function resetPuzzle($emoji_puzzles) {
    $previous_emoji = $_SESSION['current_emoji'] ?? null;

    // Avoid repeating the same emoji
    $filtered_puzzles = $emoji_puzzles;
    if ($previous_emoji !== null && count($emoji_puzzles) > 1) {
        unset($filtered_puzzles[$previous_emoji]);
    }

    $_SESSION['current_emoji'] = array_rand($filtered_puzzles);
    $_SESSION['attempts'] = 0;
    $_SESSION['correct_guess'] = false;
    $_SESSION['puzzle_over'] = false;
}

// First time loading puzzle
if (!isset($_SESSION['current_emoji'])) {
    resetPuzzle($emoji_puzzles);
    $_SESSION['puzzles_completed'] = 0; // Track solved puzzles
    $_SESSION['show_curtain'] = true;
}

// Load new puzzle after previous win or next button
if (isset($_SESSION['load_new']) && $_SESSION['load_new']) {
    resetPuzzle($emoji_puzzles);
    unset($_SESSION['load_new']);
    $_SESSION['show_curtain'] = true;
}

if (isset($_POST['next_puzzle'])) {
    resetPuzzle($emoji_puzzles);
    $_SESSION['show_curtain'] = true;
}

$current_emoji = $_SESSION['current_emoji'];
$correct_answer = $emoji_puzzles[$current_emoji];

$feedback_message = '';
$attempts_left = 3 - ($_SESSION['attempts'] ?? 0);
$show_form = !$_SESSION['puzzle_over'];

// Handle guess submission
if (isset($_POST['submit_guess']) && !$_SESSION['puzzle_over']) {
    $user_guess = trim($_POST['guess']);

    if (strcasecmp($user_guess, $correct_answer) === 0) {
        $_SESSION['correct_guess'] = true;
        $_SESSION['puzzle_over'] = true;
        $show_form = false;

        // Increment puzzle count
        $_SESSION['puzzles_completed'] = ($_SESSION['puzzles_completed'] ?? 0) + 1;

        // Redirect to result if two puzzles completed
        if ($_SESSION['puzzles_completed'] >= 2) {
            header("Location: result.php");
            exit;
        }

        // Otherwise, go to next puzzle
        $_SESSION['load_new'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $_SESSION['attempts']++;
        $attempts_left = 3 - $_SESSION['attempts'];

        if ($_SESSION['attempts'] >= 3) {
            $feedback_message = "❌ Out of attempts! The correct answer was: <strong>$correct_answer</strong>";
            $_SESSION['puzzle_over'] = true;
            $show_form = false;
        } else {
            $feedback_message = "❌ Incorrect! You have $attempts_left attempt(s) left.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guess The Movie</title>
    <link rel="stylesheet" href="css/puzzle3.css">
    <link rel="stylesheet" href="css/timer.css">
</head>
<body>
<p class="timer">Time Elapsed: <?php echo $formattedTime; ?></p>
<?php if ($_SESSION['show_curtain']): ?>
    <div class="curtain-gif"></div>
    <?php $_SESSION['show_curtain'] = false; ?>
<?php endif; ?>

<div class="content-wrapper">
    <h1>Guess The Movie</h1>
    <p>Guess the Movie represented by these emojis:</p>

    <div class="puzzle"><?php echo htmlspecialchars($current_emoji); ?></div>

    <?php if ($show_form): ?>
        <div class="form">
            <form method="POST">
                <input type="text" name="guess" placeholder="Your Guess" required>
                <button type="submit" name="submit_guess" class="btn">Submit</button>
            </form>
        </div>
        <p>Attempts left: <?php echo $attempts_left; ?></p>
    <?php endif; ?>

    <?php if (!empty($feedback_message)): ?>
        <div class="message <?php echo $_SESSION['correct_guess'] ? 'correct' : 'incorrect'; ?>">
            <?php echo $feedback_message; ?>
        </div>
    <?php endif; ?>

    <?php if ($_SESSION['puzzle_over'] && !$_SESSION['correct_guess']): ?>
        <form method="POST">
            <button type="submit" name="next_puzzle" class="btn" style="margin-top: 20px;">Next Puzzle</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>


