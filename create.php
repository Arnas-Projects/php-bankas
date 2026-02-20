<?php

# Form to create new account

require 'functions/iban.php';
require 'functions/validation.php';
require 'functions/storage.php';
require 'templates/header.php';
require 'functions/auth.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accounts = getAccounts();

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $personalCode = $_POST['personal_code'];
    $generatedIban = generateIban();

    if (!validateName($firstName)) {
        setMessage('Vardas privalo būti ilgesnis nei 3 raidės.');
        header('Location: create.php');
        die;
    }

    if (!validateName($lastName)) {
        setMessage('Pavardė turi būti ilgesnė nei 3 raidės.');
        header('Location: create.php');
        die;
    }

    if (!validatePersonalCodeFormat($personalCode)) {
        setMessage('Asmens kodas turi būti sudarytas iš 11 skaitmenų.');
        header('Location: create.php');
        die;
    }

    if (!validatePersonalCodeUnique($personalCode, $accounts)) {
        setMessage('Asmens kodas turi būti unikalus');
        header('Location: create.php');
        die;
    }

    $newAccount = [
        'id' => uniqid(),
        'first_name' => $firstName,
        'last_name' => $lastName,
        'personal_code' => $personalCode,
        'iban' => $generatedIban,
        'balance' => 0
    ];

    $accounts[] = $newAccount;

    saveAccounts($accounts);

    header('Location: index.php');
    die;
}

$generatedIban = generateIban();

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

    <label>IBAN:</label>
    <input style="padding: 0 10px; field-sizing: content" type="text" value="<?= $generatedIban ?>" readonly>

    <br><br>

    <button type="submit">Create</button>
</form>

<?php require 'templates/footer.php';