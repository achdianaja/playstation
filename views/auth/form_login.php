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
            <img src="../../public/assets/login.png" alt="Login Image">
            <div class="login-card-content">
                <div class="text-wrapper">
                    <h2>Masuk ke akunmu</h2>
                    <p>Tidak punya akun Loket? <a href="form_register.php">Daftar</a></p>
                </div>
                <form method="POST" action="../../action/auth/login.php">
                    <input type="text" id="name" name="username" placeholder="Username" required>
                    <div class="password-wrapper">
                        <input type="password" id="pass" name="password" placeholder="Password" required>
                        <button type="button" id="togglePassword" class="btn-show">
                            <img id="eye-icon" src="../../public/assets/icons/eye.svg" alt="Show Password" width="20" height="20">
                        </button>
                    </div>
                    <input type="submit" class="btn-login" value="Masuk" name="login"></input>
                    <a href="../../index.php" class="btn btn-danger">back</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("pass");
        const eyeIcon = document.getElementById("eye-icon");

        togglePassword.addEventListener("click", function() {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);

            if (type === "text") {
                eyeIcon.src = "../../public/assets/icons/eye-crossed.svg";
                eyeIcon.alt = "Hide Password";
            } else {
                eyeIcon.src = "../../public/assets/icons/eye.svg";
                eyeIcon.alt = "Show Password";
            }
        });
    </script>

</body>

</html>