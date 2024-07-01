<?php 
include "config.php";
$message_regis = "";
$slide_class = "";

if(isset($_POST['register'])) {
    $username = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role = 'user'; // Atur peran sebagai 'user' secara default

    $checkUsername = "SELECT * FROM user WHERE username = '$username'";
    $result = $db->query($checkUsername);

    if($result->num_rows > 0) {
        $message_regis = "Username already taken";
        $slide_class = "right-panel-active"; // Tetap di slide register
    } else {
        $sql = "INSERT INTO user (username, password, email, role) VALUES ('$username', '$password', '$email', '$role')";
        if($db->query($sql)) {
            $message_regis = "Registered successfully";
            $slide_class = "right-panel-active"; // Tetap di slide register
        } else {
            $message_regis = "Failed to register";
            $slide_class = "right-panel-active"; // Tetap di slide register
        }
    }
}


$message_login = "";
if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = $db->query($sql);

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if($user['role'] == 'admin') {
            header("Location: admin/HomePage.html");
        } else {
            header("Location: HomePage.html");
        }
        exit();
    } else {
        $message_login = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/LogSin.css">
    <title>Login & Signup</title>
</head>
<body>
    <div class="container <?php echo $slide_class; ?>" id="container">
        <div class="form-container sign-up-container">
            <form action="login.php" method="POST">
                <h1>Create Account</h1>
                <span>or use your email for registration</span>
                <input type="text" name="name" placeholder="Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <?php echo "<p style='color: black; font-size:15px;'>" . $message_regis . "</p>"; ?>
                <button type="submit" name="register">Register</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <span>or use your account</span>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <?php echo "<p style='color: black; font-size:15px;'>" . $message_login . "</p>"; ?>
                <a href="#">Forgot your password?</a>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Register</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./js/LogSin.js"></script>
</body>
</html>
