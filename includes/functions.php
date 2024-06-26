<?php

function secure()
{
    if (!isset($_SESSION['id'])) {
        echo "Kindly log in first.";
        die();
    }
}

function loggedIn()
{
    if (isset($_SESSION['id'])) {
        header('location: dashboard.php');
    }
}

function set_message($message)
{
    $_SESSION['message'] = $message;
}

function get_message()
{
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p> <hr>';
        unset($_SESSION['message']);
    }
}
?>