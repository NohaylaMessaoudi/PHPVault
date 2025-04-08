<?php
session_start();
$_SESSION['start_time'] = time();
$_SESSION['score'] = 100;
$_SESSION['hints'] = 0;
$_SESSION['level'] = 1;
header("Location: puzzle1.php");
exit;
