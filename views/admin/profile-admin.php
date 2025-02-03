<?php
$page = "Profiles";
include '../../connection.php';
include '../../components/head.php';
date_default_timezone_set('Asia/Jakarta');

$query = "SELECT * FROM user WHERE user_id = '$_SESSION[userid]'";
$user = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($user);

?>
<div class="container mt-5 checkout-container">
    <div class="checkout-wrapper">
        <h1>
            <a href="../dashboard.php" class="btn btn-outline-info btn-sm mr-3">←</a> <?= $page ?>
        </h1>
        <div class="row mb-3">
            <div class="col-3" style="height: 100%;">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div style="text-align: center;" class="mb-4">
                                <img src="../../public/assets/images/user/<?= $data['user_photo'] ?>"
                                    alt="User Photo" class="image" width="100" height="100"
                                    style="border-radius: 50%; padding: 5px; background: white; border: 2px solid #007bff;">
                                <h3 class="card-title"><?= $data['name'] ?></h3>
                            </div>
                            <div class="mb-4">
                                <strong>Username : </strong>
                                <p><?= $data['username'] ?></p>
                            </div>
                            <div class="mb-4">
                                <strong>Phone : </strong>
                                <p><?= $data['phone'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9" style="height: 100%;">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form method="POST" action="../../action/user/update_user.php" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                                <input type="hidden" name="old_photo" value="<?= $data['user_photo'] ?>">

                                <div class="form-group">
                                    <label for="photo" class="form-label">New Photo</label>
                                    <input type="file" name="user_photo" class="form-control">
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" id="name" name="name" value="<?= $data['name'] ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" id="username" name="username" value="<?= $data['username'] ?>" class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="number" id="phone" name="phone" value="<?= $data['phone'] ?>" class="form-control" required>
                                </div>

                                <input type="submit" class="btn btn-success" value="Save Changes" name="update">
                                <a href="change_password_admin.php?id=<?= $data['user_id'] ?>" class="btn btn-primary">Change password</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "../../components/footer.php"; ?>