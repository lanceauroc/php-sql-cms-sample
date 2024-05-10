<?php

function secure()
{
    if (!isset($_SESSION['id'])) {
        echo "Kindly log in first.";
        die();
    }
}

?>