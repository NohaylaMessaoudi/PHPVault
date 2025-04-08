<?php
session_start();

$errorUsername = $errorPassword = "";
$username = $password = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $valid = true;

    if (empty($username)) {
        $errorUsername = "Username is required.";
        $valid = false;
    }

    if (empty($password)) {
        $errorPassword = "Password is required.";
        $valid = false;
    }

    if ($valid) {
        // Store user info in session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;  // Not secure for real use
        $_SESSION['score'] = 100;
        $_SESSION['hints'] = 0;
        $_SESSION['level'] = 1;

        // Optional: Save to file
        $entry = "$username|$password\n";
        file_put_contents("players.txt", $entry, FILE_APPEND);

        // Redirect to start of game
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - The PHP Vault</title>
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>

<h2>Create Your Account</h2>

<form method="post">
    <div>
        <label for="username">Username:</label><br>
        <span class="error"><?php echo $errorUsername; ?></span><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
    </div><br>

    <div>
        <label for="password">Password:</label><br>
        <span class="error"><?php echo $errorPassword; ?></span><br>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
    </div><br>

    <button type="submit">Start Game</button>
</form>

</body>
</html>
