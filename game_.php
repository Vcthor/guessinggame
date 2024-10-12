
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Guessing Game</title>
</head>
<body>
    <h1>Guess the Secret Number (1-10)</h1>
    <form method="post">
        <input type="number" name="guess" min="1" max="10" required>
        <button type="submit">Submit Guess</button>
    </form>
    <?php
    if (isset($_SESSION['attempts']) && $_SESSION['attempts'] > 0 && $_SESSION['attempts'] < $_SESSION['maxAttempts']) {
        echo "<p>Your previous guesses: " . $_SESSION['attempts'] . "</p>";
    }
    ?>
</body>
</html>

<?php
session_start();


$secretNumber = 6;


if (!isset($_SESSION['attempts'])) {
    $_SESSION['attempts'] = 0;
}

if (!isset($_SESSION['maxAttempts'])) {
    $_SESSION['maxAttempts'] = 3;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $guess = (int)$_POST['guess'];
    $_SESSION['attempts']++;

  
    if ($guess === $secretNumber) {
        echo "Congratulations! You've guessed the secret number $secretNumber!";
        session_destroy(); 
    } else {
        if ($_SESSION['attempts'] < $_SESSION['maxAttempts']) {
            echo "Wrong guess! You have " . ($_SESSION['maxAttempts'] - $_SESSION['attempts']) . " attempts left.";
        } else {
            echo "Game over! The secret number was $secretNumber.";
            session_destroy(); 
        }
    }
}
?>
