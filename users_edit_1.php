<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');
secure();
include ('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        if ($stm = $connect->prepare('INSERT INTO users(username, email, password, active) VALUES (?, ?, ?, ?)')) {
            $hashed_pw = SHA1($_POST['password']);
            $stm->bind_param('ssss', $_POST['username'], $_POST['email'], $hashed_pw, $_POST['active']);
            $stm->execute();

            set_message("A new user, " . $_POST['username'] . ", has been added.");
            header('Location: users.php');
            $stm->close();
            die();
        } else {
            echo "Statement could not be prepared.";
        }
    }
}

$user = null;
if (isset($_GET['id'])) {
    if ($stm = $connect->prepare('SELECT * FROM users WHERE id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();
        $result = $stm->get_result();
        $user = $result->fetch_assoc();
        $stm->close();
    } else {
        echo "Statement could not be prepared.";
    }
}

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="display-4"><?php echo $user ? 'Edit User' : 'Add User'; ?></h1>
            <form method="post">
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control"
                        value="<?php echo $user ? htmlspecialchars($user['username']) : ''; ?>" />
                    <label class="form-label" for="username">Username</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control"
                        value="<?php echo $user ? htmlspecialchars($user['email']) : ''; ?>" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <select name="active" class="form-select" id="active">
                        <option value="1" <?php echo $user && $user['active'] == 1 ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo $user && $user['active'] == 0 ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>

                <button data-mdb-ripple-init type="submit"
                    class="btn btn-primary btn-block"><?php echo $user ? 'Update User' : 'Add User'; ?></button>
            </form>
        </div>
    </div>
</div>

<?php
include ('includes/footer.php');
?>