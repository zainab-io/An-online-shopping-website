<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $sql = "INSERT INTO users (username, email, password, phone_number, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email, $password, $phone_number, $address]);

    echo "Registration successful!";
}
?>














<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<title>NOORAN | Ecommerce Website Design</title>
<link rel="stylesheet" href="in.css">
<script src="cart.js"></script>
<link href="https://fonts.googleapis.com/css2?
family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no">

</head>
<body>
    <div class="header"></div>
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <img src="img/logo.jpg" width="90px">
            </div>
            <nav>
                <ul>
                    <li><a href="index.html"><b>Home</b></a></li>
                    
             
                 
                </ul>
            </nav>
        </div>



      <div class="signin">
                <!-- Title section -->
                <div class="title">Fill this form to confirm your order</div>
                <div class="content">
<form action="register.php" method="POST">
<div class="user-details">
                      <!-- Input for Full Name -->
                      <div class="input-box">
                        <span class="details">User Name</span>
                        <input type="text" name="username" placeholder="Enter your name" required>
                      </div>
                      
                      <!-- Input for Email -->
                      <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" name="email" placeholder="Enter your email" required>
                      </div>
                       <!-- Input for Password -->
                       <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" placeholder="Enter your number" required>
                      </div>
                      <!-- Input for Phone Number -->
                      <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input  type="text" name="phone_number" placeholder="Enter your number" required>
                      </div>
                      <!-- Input for Address-->
                      <div class="input-box">
                        <span class="details">Address</span>
                        <textarea name="address" placeholder="Address"></textarea>
                      </div>
                     
                    <!-- Submit button -->
                    <div class=" submit button">
                      <input type="submit" value="Register">
                    </div>
</form>
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