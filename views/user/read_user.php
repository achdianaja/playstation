<?php
$title = 'user';
$page = 'User List';
include '../../components/head.php';

?>

<div class="container mt-5">
    <div style="display: flex; justify-content:space-between">
        <h1>
            <a href="../dashboard.php" class="btn btn-outline-info btn-sm mr-3">←</a> List User
        </h1>
        <p><a class="btn btn-success btn-sm" href="add_user.php">Add New User</a></p>
    </div>
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
                            <td><img src="/playstation/public/assets/images/user/<?= $data['user_photo']; ?>" alt="User Photo" class="image" width="50" height="50" style="border-radius: 100%;"></td>
                            <td><?php echo $data['name']; ?></td>
                            <td><?= $data['username']; ?></td>
                            <td><?= $data['phone']; ?></td>
                            <td>
                                <a href="../../action/user/delete_user.php?id=<?= $data['user_id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                <a href="detail_user.php?id=<?= $data['user_id'] ?>" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../../components/footer.php' ?>