<?php

# sorting, redirecting, flash messages

function setMessage($message, $type = 'error')
{
    $_SESSION['message'] = [
        'text' => $message,
        'type' => $type
    ];
}

function getMessage()
{
    if (isset($_SESSION['message'])) {
        $msg = $_SESSION['message'];
        unset($_SESSION['message']);
        return $msg;
    }

    return null;
}

function getRoleLabel($role)
{
    $roles = [
        'admin' => 'Administratorius',
        'staff' => 'Reguliarus'
    ];

    return $roles[$role] ?? 'Nežinomas';
}