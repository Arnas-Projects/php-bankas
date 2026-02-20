<?php

# generate Lithuanian IBAN

function generateIban()
{
    $countryCode = 'LT';
    $checkDigits = rand(10, 99);

    $accountNumber = '';

    for ($i = 0; $i < 16; $i++) {
        $accountNumber .= rand(0, 9);
    }

    return $countryCode . $checkDigits . $accountNumber;
}