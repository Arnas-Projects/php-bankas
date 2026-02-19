<?php

# Handles deletion (POST only)

require 'functions/storage.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accounts = getAccounts();
    $id = $_POST['id'];

    foreach ($accounts as $key => $account) {

        if ($account['id'] === $id) {

            if ($account['balance'] > 0) {
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