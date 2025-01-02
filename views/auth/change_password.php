<?php
session_start();
include '../../koneksi.php';
$query = "SELECT * FROM pets_230012 WHERE pet_id_230012='$_GET[id]'";

$pet = mysqli_query($db_con, $query);

$data = mysqli_fetch_assoc($pet);
$page = "Change Password";
include "../../components/head.php";
?>

<h1>Change Password</h1>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form action="../../action/auth/update_password_230012.php" method="POST">
                <div class="form-group">
                    <label class="form-label" for="pass">New Password : </label>
                    <input type="password" name="new_password_230012" id="pass" required class="form-control">
                    <button onclick="show()" type="button" class="btn btn-primary btn-sm">Show</button>
                </div>
                <div class="form-group" style="display:flex; justify-content:flex-end;">
                    <input type="submit" value="CHANGE" name="change" required class="btn btn-success btn-sm mx-3">
                    <input type="reset" value="RESET" required class="btn btn-secondary btn-sm">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function show() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php include "../../components/footer.php"; ?>