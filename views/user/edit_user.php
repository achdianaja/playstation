<?php
$page = "User | Form Edit";

include '../../components/head.php';
include "../../connection.php";
$query = "SELECT * FROM user WHERE user_id ='$_GET[id]'";
$pet = mysqli_query($db_connection, $query);
$data = mysqli_fetch_assoc($pet);

?>

<h1>Form Edit </h1>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form action="../../action/user/update_user.php" method="POST">
                <div class="form-group">
                    <label for="name" class="form-label">Fullname</label>
                    <input type="text" name="fullname" id="name" value="<?= $data['fullname'] ?>" required class="form-control">
                    <input type="hidden" name="user_id" id="" value="<?= $data['user_id']?>">
                </div>
                
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" value="<?= $data['username']?>" required class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="phone" id="phone" value="<?= $data['phone']?>" required class="form-control">
                </div>
 
                <div class="form-group" style="display:flex; justify-content:flex-end;">
                    <button type="submit" name="save" class="btn btn-success mx-3">SAVE</button>
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../../components/footer.php' ?>