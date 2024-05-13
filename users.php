<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');

include ('includes/header.php');

secure();

if ($stm = $connect->prepare('SELECT * FROM users')) {
    $stm->execute();

    $result = $stm->get_result();
    $user = $result->fetch_assoc();

    var_dump($user);
    die();
    if ($user) {

        ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1 class="display-1">Users Management</h1>
                    <table>
                        <!-- TODO:: Place table elements here -->
                    </table>
                </div>
            </div>
        </div>

        <?php
    }

    echo "No users found.";
    $stm->close();

} else {
    echo "Statement could not be prepared.";
}

include ('includes/footer.php'); ?>