<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');

include ('includes/header.php');

secure();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">CMS Dashboard</h1>
            <a href="users.php">Users Management</a>
            <a href="posts.php">Posts Management</a>
        </div>
    </div>
</div>


<?php include ('includes/footer.php'); ?>