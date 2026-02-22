<?php

$pageTitle = 'PHP Bankas - Pinigų įnešimas';

# Page to add money

require 'functions/validation.php';
require 'functions/storage.php';
require 'templates/header.php';
require 'functions/auth.php';

requireLogin();


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

    if(!validateAmount($amount)) {
        setMessage('Suma, kurią bandote įnešti turi būti teigiama');
        header("Location: add.php?id=$id");
        die;
    }

    foreach ($accounts as &$acc) {
        if ($acc['id'] === $id) {
            $acc['balance'] += $amount;
            $acc['balance'] = round($acc['balance'], 2);
            break;
        }
    }

    setMessage(
        "Jūs sėkmingai įnešėte {$amount} € į {$account['first_name']} {$account['last_name']} sąskaitą.",
        'success'
    );

    saveAccounts($accounts);

    header('Location: index.php');
    die;
}



// Show Form (GET)

?>

<h1>Inešti pinigus</h1>

<p>
    <?= $account['first_name'] ?> <?= $account['last_name'] ?>
</p>

<p>
    Dabartinis likutis: <?= $account['balance'] ?>
</p>

<form method="POST">
    <input type="number" name="amount" step="0.01" placeholder="Įrašykite sumą" required>
    <button type="submit">Patvirtinti</button>
</form>

<?php require 'templates/footer.php'; ?>