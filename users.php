<?php
include ('includes/config.php');
include ('includes/database.php');
include ('includes/functions.php');
secure();
include ('includes/header.php');

if (isset($_GET['delete'])) { //TODO:: Implement a softDelete feature instead of actually deleting
    if ($stm = $connect->prepare('DELETE FROM users where id = ?')) {
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        set_message("User, " . $_SESSION['username'] . " has been permanently deleted.");
        header('location: users.php');
        $stm->close();
        die();
    } else {
        echo "Statement could not be prepared.";
    }
}

if ($stm = $connect->prepare('SELECT * FROM users')) {
    $stm->execute();

    $result = $stm->get_result();

    if ($result->num_rows > 0) {

        ?>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1 class="display-1">Users Management</h1>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Edit | Delete</th>
                        </tr>
                        <?php while ($record = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td><?php echo $record['id']; ?></td>
                                <td><?php echo $record['username']; ?></td>
                                <td><?php echo $record['email'] ?></td>
                                <td><?php echo $record['active'] === 1 ? 'Active' : 'Inactive'; ?></td>
                                <td><a href="users_edit.php?id=<?php echo $record['id']; ?>">Edit</a> |
                                    <a href="users.php?delete=<?php echo $record['id']; ?>">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <a href="users_add.php">Add new user</a>
                </div>
            </div>
        </div>

        <?php
    } else {
        echo "No users found.";
        $stm->close();
    }

} else {
    echo "Statement could not be prepared.";
}

include ('includes/footer.php'); ?>