<?php

# Form to create new account

require 'functions/storage.php';
require 'templates/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accounts = getAccounts();

    $newAccount = [
        'id' => uniqid(),
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'personal_code' => $_POST['personal_code'],
        'iban' => 'TEMP',
        'balance' => 0
    ];

    $accounts[] = $newAccount;

    saveAccounts($accounts);

    header('Location: index.php');
    die;
}

?>

<h1>Create Account</h1>

<form method="POST">
    <label>First Name:</label>
    <input type="text" name="first_name">

    <br><br>

    <label>Last Name:</label>
    <input type="text" name="last_name">

    <br><br>

    <label>Personal Code:</label>
    <input type="text" name="personal_code">

    <br><br>

    <button type="submit">Create</button>
</form>

<?php require 'templates/footer.php';