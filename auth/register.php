<?php
include("../config/db.php");

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // DEFAULT ROLE = member
    $sql = "INSERT INTO users (name,email,password,role) 
            VALUES ('$name','$email','$password','member')";
    
    $conn->query($sql);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register - TaskForge</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f5f7fa;
}
.register-box {
    max-width: 400px;
    margin: 80px auto;
}
</style>

</head>
<body>

<div class="register-box">

<div class="card shadow-sm p-4 border-0">

<h3 class="mb-2 text-center">Create Account 🚀</h3>
<p class="text-center text-muted mb-4">Join TaskForge to manage your work</p>

<form method="POST">

<input class="form-control mb-3" type="text" name="name" placeholder="Full Name" required>

<input class="form-control mb-3" type="email" name="email" placeholder="Email" required>

<input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

<button class="btn btn-primary w-100" name="register">Register</button>

</form>

<p class="mt-3 text-center text-muted">
    Already have an account? 
    <a href="login.php" class="fw-semibold text-decoration-none">Login</a>
</p>

</div>

</div>

</body>
</html>