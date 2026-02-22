<?php

session_start();
const URL = 'http://localhost/php-bankas/';

require_once 'functions/helpers.php';

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

    <div class="container">

        <nav>
            <a href="index.php">Visos sąskaitos</a>
            <a href="create.php">Sukurti naują sąskaitą</a>

            <?php if (isset($_SESSION['user']) && $_SESSION['role'] === 'admin'): ?>
                <a href="employee_create.php">Sukurti naują vartotoją</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['user'])): ?>
                <a href="logout.php">Atsijungti</a>
            <?php endif; ?>
        </nav>

        <hr>

        <?php if (isset($_SESSION['user'])): ?>
            <div style="margin-top: 15px; font-size: 18px;">
                Prisijungęs vartotojas: <strong><?= $_SESSION['user'] ?></strong>
            </div>
            <div style="margin-top: 10px; font-size: 18px;">
                Vartotojo tipas: <strong><?= getRoleLabel($_SESSION['role']) ?></strong>
            </div>
        <?php endif; ?>

        <?php

        $message = getMessage();

        if ($message):
            $color = $message['type'] === 'success' ? 'message success' : 'message error';
        ?>
            <div class="<?= $color ?>" style="color: <?= $color ?>; margin: 10px 0;">
                <?= $message['text'] ?>
            </div>

        <?php endif; ?>