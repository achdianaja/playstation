 <?php
        //call connection 
        include "../../connection.php";

        //make thte query based on username
        $query="SELECT * FROM user WHERE user_id ='$_GET[user_id]'";

        //run the query
        $user= mysqli_query ($db_connection, $query);

        //extract data from query result
        $data= mysqli_fetch_assoc ($user);
    ?>
    <form method="post" action="user_upload.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td></td>
                <td><img src="../../public/assets/images/user/<?= $data['user_photo']; ?>" width="100" height="100" style="border-radius: 100%;"></td>
            </tr>
            <tr>
                <td>New Photo</td>
                <td>: <input type="file" name="new_photo" required></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;
                    <input type="submit" name="upload" value="UPLOAD" />
                    <input type="hidden" name="user_photo" value="<?= $data['user_photo']; ?>" />
                    <input type="hidden" name="user_id" value="<?= $data['user_id']; ?>" />
                </td>
            </tr>
        </table>
    </form>
    <!-- <p><a href=""><< Back to Pet List</a></p> -->
