<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');
secure();
include ('includes/header.php');

if (isset($_POST['username'])) {
    if ($stm = $connect->prepare('INSERT INTO users(username,email,password,active) VALUES (?,?,?,?)')) {
        $hashed_pw = SHA1($_POST['password']);
        $stm->bind_param('ssss', $_POST['username'], $_POST['email'], $hashed_pw, $_POST['active']);
        $stm->execute();

        set_message("Hi there! You are now logged in, " . $_SESSION['username'] . "!");
        header('location: users.php');

        if ($user) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];

            set_message("Hi there! You are now logged in, " . $_SESSION['username'] . "!");
            header('location: dashboard.php');
            die();
        }
        $stm->close();
    } else {
        echo "Statement could not be prepared.";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-1">Add User</h1>
            <form method="post">
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control" />
                    <label class="form-label" for="username">Username</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <select name="active" class="form-select" id="active">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Add User</button>
            </form>
        </div>
    </div>
</div>

<?php


include ('includes/footer.php'); ?>