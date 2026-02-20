<?php

session_start();
const URL = 'http://localhost/php-bankas/';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=TikTok+Sans:opsz,wght@12..36,300..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= URL ?>public/style.css">
    <title>PHP Bankas</title>
</head>

<body>

    <nav>
        <a href="index.php">Accounts</a>
        <a href="create.php">Create Account</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="employee_create.php">Sukurti naują vartotoją</a>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php">Atsijungti</a>
        <?php endif; ?>
    </nav>

    <hr>

<?php

require_once 'functions/helpers.php';
$message = getMessage();

if ($message):

?>

    <div style="color: crimson; margin: 10px 0;">
        <?= $message ?>
    </div>

<?php endif; ?>