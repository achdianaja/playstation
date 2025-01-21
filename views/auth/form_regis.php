<?php $title = "Register"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body>
    <div class="login-wrap">
        <div class="login-card">
            <!-- <h2>Login</h2> -->
            <img src="../../public/assets/logo-playstation.png" alt="logo" class="logo" width="300" height="auto">
            <form method="POST" action="../../action/auth/register.php">
                <input type="text" id="fullname" name="fullname" placeholder="Fullname" required>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="text" id="phone" name="phone" placeholder="Phone" required>
                <input type="password" id="pass" name="password" placeholder="Password" required>
                <div>
                    <input type="checkbox" name="" id="show" onclick="showPassword()">
                    <label for="show">show</label>
                </div>
                <input type="submit" class="btn-login" value="REGISTER" name="regis">
            </form>
        </div>
    </div>
    <script>
        function showPassword() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>

</html>