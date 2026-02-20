<?php

# sorting, redirecting, flash messages

function setMessage($message)
{
    $_SESSION['message'] = $message;
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