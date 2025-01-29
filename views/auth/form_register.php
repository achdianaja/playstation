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
            <img src="../../public/assets/register.png" alt="Login Image">
            <div class="login-card-content">
                <div class="text-wrapper">
                    <h2>Buat akun kamu</h2>
                    <p>Sudah punya akun? <a href="form_login.php">Masuk</a></p>
                </div>
                <form method="POST" action="../../action/auth/register.php">
                    <input type="text" id="name" name="name" placeholder="Name" required>
                    <input type="text" id="username" name="username" placeholder="Username" required>
                    <input type="email" id="email" name="email" placeholder="example@example.com" required>
                    <input type="number" id="phone" name="phone" placeholder="0891234567890" required>
                    <div class="password-wrapper">
                        <input type="password" id="pass" name="password" placeholder="Password" required>
                        <button type="button" id="togglePassword" class="btn-show">
                            <img id="eye-icon" src="../../public/assets/icons/eye.svg" alt="Show Password" width="20" height="20">
                        </button>
                    </div>
                    <input type="submit" class="btn-login" value="Register" name="register"></input>
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
