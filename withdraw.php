<?php

# Page to withdraw money

require 'functions/storage.php';
require 'templates/header.php';

$accounts = getAccounts();
$id = $_GET['id'] ?? null;

$account = null;

foreach ($accounts as $acc) {
    if ($acc['id'] === $id) {
        $account = $acc;
        break;
    }
}

if (!$account) {
    echo 'Account not found';
    require 'templates/footer.php';
    die;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $amount = (float) $_POST['amount'];

    foreach ($accounts as &$acc) {
        if ($acc['id'] === $id) {

            // IMPORTANT RULE
            if ($acc['balance'] >= $amount) {
                $acc['balance'] -= $amount;
            }

            break;
        }
    }

    saveAccounts($accounts);

    header('Location: index.php');
    die;
}

?>

<h1>Withdraw Money</h1>

<p>
    <?= $account['first_name'] ?> <?= $account['last_name'] ?>
</p>

<p>
    Current balance: <?= $account['balance'] ?>
</p>

<form method="POST">
    <input type="number" name="amount" step="0.01" required>
    <button type="submit">Withdraw</button>
</form>

<?= require 'templates/footer.php'; ?>