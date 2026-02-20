<?php

require 'templates/header.php';
require 'functions/auth.php';
require 'functions/storage.php';
require_once 'functions/helpers.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (strlen($username) < 4) {
        setMessage('Vartotojo vardas negali būti trumpesnis nei 4 simboliai.');
        header('Location: employee_create.php');
        die;
    }

    if (strlen($password) < 4) {
        setMessage('Slaptažodis negali būti trumpesnis nei 4 simboliai.');
        header('Location: employee_create.php');
        die;
    }

    $employees = getEmployees();

    foreach ($employees as $employee) {
        if ($employee['username'] === $username) {
            setMessage('Toks vartotojo vardas jau egzistuoja!');
            header('Location: employee_create.php');
            die;
        }
    }

    $employees[] = [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];

    saveEmployees($employees);

    setMessage('Darbuotojo profilis sėkmingai sukurtas!');
    header('Location: index.php');
    die;
}

?>

<h1>Sukurti Paskyrą</h1>

<form method="POST">
    <input type="text" name="username" placeholder="Vartotojo vardas">

    <br>
    <br>

    <input type="password" name="password" placeholder="Slaptažodis">

    <br>
    <br>

    <button type="submit">Sukurti vartotoją</button>
</form>

<?php require 'templates/footer.php'; ?>