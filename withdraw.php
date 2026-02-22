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
                $acc['balance'] = round($acc['balance'], 2);
            } else {
                setMessage('Sąskaitoje nepakanka pinigų.');
                header("Location: withdraw.php?id=$id");
                die;
            }

            break;
        }
    }

    setMessage("Jūs sėkmingai nuskaičiavote {$amount} € nuo {$account['first_name']} {$account['last_name']} sąskaitos.",
    'error'
    );

    saveAccounts($accounts);

    header('Location: index.php');
    die;
}

?>

<h1>Pinigų išėmimas</h1>

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