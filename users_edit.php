<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');
secure();
include ('includes/header.php');

if (isset($_POST['username'])) {
    if ($stm = $connect->prepare('UPDATE users set username = ?,email = ?,active = ? WHERE id = ?')) {
        $stm->bind_param('sssi', $_POST['username'], $_POST['email'], $_POST['active'], $_GET['id']);
        $stm->execute();

        $stm->close();

        // TODO:: The validation should be if the current password input matches the one from db
        if (isset($_POST['current_password'])) {
            if ($stm = $connect->prepare('UPDATE users set password = ? WHERE id = ?')) {
                $hashed_pw = SHA1($_POST['new_password']);
                $stm->bind_param('si', $hashed_pw, $_GET['id']);
                $stm->execute();

                $stm->close();
            } else {
                echo "Password update tatement could not be prepared.";
            }

        } else {
            echo "User update statement could not be prepared.";
        }

        set_message("The details of user " . $_POST['username'] . " has been updated.");
        header('location: users.php');
        die();
    }
}

if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('SELECT * FROM users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user) {


            ?>

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1 class="display-1">Edit User</h1>
                        <form method="post">
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="text" id="username" name="username" class="form-control active"
                                    value="<?php echo $user['username']; ?>" />
                                <label class="form-label" for="username">Username</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control active"
                                    value="<?php echo $user['email']; ?>" />
                                <label class="form-label" for="email">Email address</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="current_password" name="current_password" class="form-control" />
                                <label class="form-label" for="current_password">Current Password</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="new_password" name="new_password" class="form-control" />
                                <label class="form-label" for="new_password">New Password</label>
                            </div>

                            <div data-mdb-input-init class="form-outline mb-4">
                                <select name="active" class="form-select" id="active">
                                    <option <?php echo ($user['active']) ? "selected" : ""; ?> value="1">Active</option>
                                    <option <?php echo ($user['active']) ? "" : "selected"; ?> value="0">Inactive</option>
                                </select>
                            </div>

                            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Update User</button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
        }
        $stm->close();
        die();
    } else {
        echo "Statement could not be prepared.";
    }
} else {
    echo "No user selected.";
    die();
}

include ('includes/footer.php'); ?>