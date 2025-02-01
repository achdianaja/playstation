<?php
$page = "Profile Admin";
include '../../connection.php';
include '../../components/head.php';
date_default_timezone_set('Asia/Jakarta'); //ki maap mau nanya, kalo ga salah ini mah nyambung nya ke history user bukan? 
                                            //bukan buat card profile nya kan? kalo di apus booleh ki?
$query = "SELECT * FROM user WHERE user_id = '$_SESSION[userid]'";
$user = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($user);

?>

<div class="container mt-5 checkout-container">
    <div class="checkout-wrapper">
        <h1>
            <a href="../dashboard.php" class="btn btn-outline-info btn-sm mr-3">←</a> <?= $page ?>
        </h1>
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form method="POST" action="../../action/user/update_user.php" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                        <input type="hidden" name="old_photo" value="<?= $data['user_photo'] ?>">

                        <div class="form-group" style="display: flex; justify-content: center;">
                            <img src="../../public/assets/images/user/<?=$data['user_photo']?>"
                                alt="User Photo" class="image" width="100" height="100" style="border-radius: 100%;">
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

                        <input type="submit" class="btn btn-success" value="Update" name="update">
                        <a href="change-password.php" class="btn btn-primary">Change password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "../../components/footer.php"; ?>