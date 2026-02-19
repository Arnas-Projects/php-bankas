<?php

# Page to add money

require 'functions/storage.php';
require 'templates/header.php';


// Finding account

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


// Add Money Logic (POST)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $amount = (float) $_POST['amount'];

    foreach ($accounts as &$acc) {
        if ($acc['id'] === $id) {
            $acc['balance'] += $amount;
            break;
        }
    }

    saveAccounts($accounts);

    header('Location: index.php');
    die;
}



// Show Form (GET)

?>

<h1>Add Money</h1>

<p>
    <?= $account['first_name'] ?> <?= $account['last_name'] ?>
</p>

<p>
    Current balance: <?= $account['balance'] ?>
</p>

<form method="POST">
    <input type="number" name="amount" step="0.01" required>
    <button type="submit">Add</button>
</form>

<?php require 'templates/footer.php'; ?>