<?php
$title = 'user';
$page = 'read_user';
include '../components/head.php';

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
                        <th>Fullname</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Phone</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
        include "../connection.php";
        $query = "SELECT * FROM user";
        $user = mysqli_query($db_connection, $query);

        $i=1;
        foreach ($user as $data) :
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo $data['fullname']; ?></td>
            <td><?= $data['username']; ?></td>
            <td><?= $data['password']; ?></td>
            <td><?= $data['phone']; ?></td>
            <td><a href="edit_user230018.php?id=<?=$data['user_id']?> ">Edit User</a></td>
            <td><a href="delete_user230018.php?id=<?=$data['user_id']?>" onclick= "return confirm('Are you sure?')">Delete User</a></td>
            <td><a href="reset_user230018.php?id=<?=$data['user_id'];?>&username=<?=$data['username'];?>" 
            onclick= "return confirm('Are you sure?')">Reset Password</a></td>
        </tr>
        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../components/footer.php' ?>