<?php

require 'functions/storage.php';
require 'templates/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $employees = getEmployees();

    foreach ($employees as $employee) {
        
        if ($employee['username'] === $username && password_verify($password, $employee['password'])) {

            $_SESSION['user'] = $username;

            header('Location: index.php');
            die;
        }
    }

    setMessage('Neteisingi prisijungimo duomenys.');
    header('Location: login.php');
    die;
}

?>

<h1>Prisijungimas</h1>

<form method="POST">
    <input type="text" name="username" placeholder="Vartotojo vardas">

    <br>
    <br>

    <input type="password" name="password" placeholder="Slaptažodis" autocomplete="off">

    <br>
    <br>

    <button type="submit">Prisijungti</button>
</form>

<?php require 'templates/footer.php'; ?>