<?php
session_start();
include '../../connection.php';
$query = "SELECT * FROM user WHERE user_id = '$_GET[id]'";

$pet = mysqli_query($db_connection, $query);

$data = mysqli_fetch_assoc($pet);
$page = "Change Password";
include "../../components/head.php";
?>

<div class="container mt-4" style="height: 71vh;">
    <h1><a href="../dashboard.php" class="btn btn-outline-info btn-sm mr-3">←</a> <?= $page ?></h1>
    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="../../action/auth/update_password.php" method="POST">
                    <div class="form-group">
                        <div class="row">
                            <label class="form-label" for="pass">New Password : </label>
                            <div class="col-11">
                                <input type="password" name="new_password" id="pass" required class="form-control">
                            </div>
                            <div class="col-1">
                                <button onclick="show()" type="button" class="btn btn-primary">Show</button>
                            </div>
                        </div>

                    </div>
                    <div class="form-group mt-5" style="display:flex; justify-content:flex-end;">
                        <input type="submit" value="CHANGE" name="change" required class="btn btn-success mx-3">
                        <input type="reset" value="RESET" required class="btn btn-secondary">
                    </div>
                </form>
            </div>
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