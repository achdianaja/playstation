<?php $title = "Login"; ?>

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
            <h2>Login</h2>
            <form method="POST" action="../../action/auth/login.php">
                <input type="text" id="name" name="username" placeholder="Username" required>
                <input type="password" id="pass" name="password" placeholder="Password" required>
                <div>
                    <input type="checkbox" name="" id="show" onclick="showPassword()">
                    <label for="show">show</label>
                </div>
                <input type="submit" class="btn-login" value="LOGIN" name="login"></input>
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