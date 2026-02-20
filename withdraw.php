<?php

# Page to withdraw money

require 'functions/validation.php';
require 'functions/storage.php';
require 'templates/header.php';
require 'functions/auth.php';

requireLogin();

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

    if(!validateAmount($amount)) {
        setMessage('Suma kurią bandote išimti turi būti teigiama');
        header("Location: withdraw.php?id=$id");
        die;
    }

    foreach ($accounts as &$acc) {
        if ($acc['id'] === $id) {

            // IMPORTANT RULE
            if ($acc['balance'] >= $amount) {
                $acc['balance'] -= $amount;
            } else {
                setMessage('Sąskaitoje nepakanka pinigų.');
                header("Location: withdraw.php?id=$id");
                die;
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

<?php require 'templates/footer.php'; ?>