<?php
session_start();
session_destroy(); // Reset session when returning to homepage
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>The PHP Vault</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background: url('door.gif') no-repeat center center fixed;
            background-color: black;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            overflow: hidden;
            padding-top: 25vh;
            position: relative;
        }

        .vault-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            object-fit: cover;
            z-index: 9999;
            animation: fadeVault 5s ease-out forwards;
        }

        @keyframes fadeVault {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                visibility: hidden;
            }
        }

        .wrapper {
            display: flex;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }

        .container {
           
            padding: 1.8rem;
            border-radius: 10px;
            width: 100%;
            max-width: 397px;
            height: 75vh;
            max-height: 85vh;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        h1 {
            font-size: 2.6rem;
            color: #00ffc8;
            text-shadow: 0 0 15px #00ffc8, 0 0 30px #00ffcc;
            animation: fadeIn 3.5s ease-in-out;
            margin-bottom: 1rem;
        }

        .instructions {
            font-size: 1.05rem;
            line-height: 1.6;
            font-weight: 400;
            color: #ffffff;
            flex-grow: 1;
        }

        .start-button {
            margin-top: 0.6rem;
            padding: 1rem;
            background: transparent;
            border: none;
            border-radius: 35px;
            cursor: pointer;
            transition: all 0.4s ease;
        }

        .start-button:hover .lock-icon {
            transform: scale(1.1);
            filter: drop-shadow(0 0 10px #00ffc8);   
        }

        .lock-icon {
            width: 150px;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .start-text {
            font-size: 1.2rem;
            filter: drop-shadow(0 0 10px #00ffcc);
            color: white ;
            margin-top: -30px;
            text-transform: uppercase;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 900px) {
            .wrapper {
                flex-direction: column;
                align-items: center;
            }

            .container {
                margin-top: 3vh;
                height: auto;
            }
        }

        @media (max-width: 600px) {
            h1 {
                font-size: 2.2rem;
            }

            .container {
                padding: 1.2rem;
            }

            .instructions {
                font-size: 0.95rem;
            }

            .start-button {
                padding: 0.8rem 2rem;
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>
    <img src="gold.png" alt="Vault Image" class="vault-image">

    <div class="wrapper">
        <div class="container">
            <h1>The PHP Vault 🔐</h1>
            <div class="instructions">
                In this escape room, You will solve a series of three puzzles to unlock doors and ultimately escape the vault. You’ll enter answers into forms, If the answer is correct, the vault door unlocks. If not, the field shakes and it will prompt you to try again. If you need help, use a hint—but hints lower your score.Your progress is saved and at the end, you'll see your time, hints used, and final score.
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
