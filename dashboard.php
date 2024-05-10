<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');

include ('includes/header.php');

var_dump($_SESSION); // displays the session contents in an array

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            Welcome to the Dashboard!
        </div>
    </div>
</div>


<?php include ('includes/footer.php'); ?>