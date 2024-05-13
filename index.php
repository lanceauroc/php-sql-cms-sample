<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');

include ('includes/header.php');

if (isset($_POST['email'])) {
    if ($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ? AND active = 1')) {
        $hashed_pw = SHA1($_POST['password']);
        $stm->bind_param('ss', $_POST['email'], $hashed_pw);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

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
            <form method="post">
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>


<?php include ('includes/footer.php'); ?>