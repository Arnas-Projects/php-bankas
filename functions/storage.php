<?php

# read/write JSON file

function getAccounts()
{
    $file = __DIR__ . '/../data/accounts.json';

    if (!file_exists($file)) {
        return [];
    }

    $json = file_get_contents($file);
    $accounts = json_decode($json, true);

    if (!$accounts) {
        return [];
    }

    return $accounts;
}

function saveAccounts($accounts) {
    $file = __DIR__ . '/../data/accounts.json';
    $json = json_encode($accounts, JSON_PRETTY_PRINT);
    file_put_contents($file, $json);
}


function getEmployees()
{
    $file = __DIR__ . '/../data/employees.json';

    if (!file_exists($file)) {
        return [];
    }

    $json = file_get_contents($file);
    $employees = json_decode($json, true);

    return $employees ? : [];
}

function saveEmployees($employees)
{
    $file = __DIR__ . '/../data/employees.json';
    $json = json_encode($employees, JSON_PRETTY_PRINT);
    file_put_contents($file, $json);
}