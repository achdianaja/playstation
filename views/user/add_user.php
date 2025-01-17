<?php
$page = "User | Form Add";

include '../../components/head.php';

?>

<h1>Form Add </h1>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <form action="../../action/user/create_user.php" method="POST">
                <div class="form-group">
                    <label for="name" class="form-label">Fullname</label>
                    <input type="text" name="fullname" id="name" required class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" required class="form-control">
                </div>
                
                <div class="form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" name="phone" id="phone" required class="form-control">
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