<?php

$page = "Profiles";
include '../../connection.php';
include "../../components/head-user.php";

$query = "SELECT * FROM user WHERE user_id ='$_SESSION[userid]'";

$user = mysqli_query($db_connection, $query);

$data = mysqli_fetch_assoc($user);
?>

<div class="container mt-5 checkout-container">
    <div class="checkout-wrapper">
        <h1><?= $page ?></h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="../../action/user/update_user.php">
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" value="<?= $data['name'] ?>" class="form-control" required>
                        <input type="hidden" id="id" name="id" value="<?= $data['user_id'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Username</label>

                        <input type="text" id="username" name="username" value="<?= $data['username'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Phone</label>
                        <input type="number" id="phone" name="phone" value="<?= $data['phone'] ?>" class="form-control" required>
                    </div>
                    <input type="submit" class="btn btn-success" value="Update" name="update">
                    <a href="change-password.php" class="btn btn-primary">Change password</a>
                    <a href="../../action/user/user_upload.php" class="btn btn-info">Update photo</a>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include "../../components/footer-user.php"; ?>