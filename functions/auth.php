<?php

function requireLogin()
{
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        die;
    }
}