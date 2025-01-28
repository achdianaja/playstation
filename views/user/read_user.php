<?php
$title = 'user';
$page = 'read_user';
include '../../components/head.php';

?>
<h1>user List</h1>

<div class="container mt-5">
    <p><a class="btn btn-success btn-sm" href="add_user.php">Add New User</a></p>
    <div class="card">
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../../connection.php";
                    $query = "SELECT * FROM user WHERE role_id = 2";
                    $user = mysqli_query($db_connection, $query);

                    $i = 1;
                    foreach ($user as $data) :
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><img src="/playstation/public/assets/images/user/<?= $data['user_photo']; ?>" alt="User Photo" width="50" height="auto" style="border-radius: 100%;"></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td><?= $data['phone']; ?></td>
                            <td><a href="delete_user.php?id=<?= $data['user_id'] ?>" class="btn btn-outline-info" onclick="return confirm('Are you sure?')">Delete User</a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer.php' ?>