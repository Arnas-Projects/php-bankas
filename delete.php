<?php

session_start();
# Handles deletion (POST only)

require 'functions/storage.php';
require 'functions/helpers.php';
require 'functions/auth.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accounts = getAccounts();
    $id = $_POST['id'];

    foreach ($accounts as $key => $account) {

        if ($account['id'] === $id) {

            if ($account['balance'] > 0) {
                setMessage('Negalima ištrinti banko sąskaitos, kurioje yra pinigų.');
                header('Location: index.php');
                die;
            }

            unset($accounts[$key]);
        }
    }

    saveAccounts(array_values($accounts));
}

header('Location: index.php');
die;