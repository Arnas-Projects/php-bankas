<?php

# check personal code, name length, balance rules

function validateName($name) 
{
    return strlen(trim($name)) > 3;
}

function validatePersonalCodeUnique($personalCode, $accounts)
{
    foreach ($accounts as $account) {
        if ($account['personal_code'] === $personalCode) {
            return false;
        }
    }
    return true;
}

function validateAmount($amount)
{
    return $amount > 0;
}