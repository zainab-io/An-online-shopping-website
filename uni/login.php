<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.html"); // Redirect to home page
    } else {
        echo "Invalid username or password!";
    }
}
?>











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NOORAN | Ecommerce Website Design</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <div class="header"></div>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="img/logo.jpg" width="90px" >
            </div>
            <nav>
                <ul>
                    <li><a href="index.html"><b>Home</b></a></li>
              
                </ul>
            </nav>
        </div>




        <!-- Login Form Section -->
        <div class="login-section" id="login">
            <div class="container">
                <h1>Login</h1>
                <form action="login.php" method="POST" class="form-hover">
    <input type="text" name="username" placeholder="Username"class="details" required><br><br>
    <input type="password" name="password" placeholder="Password" class="details" required><br><br>
    <input type="submit" value="Login" class="submit-button">
</form>
                <p>Don't have an account? <a href="register.php">Sign Up</a></p>
            </div>
        </div>


    </div>

<footer>
        <div class="social">
            <ul>
                <li><a href="#" class="fa fa-facebook"></a></li>
                <li><a href="#" class="fa fa-twitter"></a></li>
                <li><a href="#" class="fa fa-instagram"></a></li>
            </ul>
        </div>
    </footer>
</body>
</html>