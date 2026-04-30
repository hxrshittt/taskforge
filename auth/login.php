<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../config/db.php");

// HANDLE LOGIN
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        header("Location: ../dashboard/index.php");
        exit();
    } else {
        $error = "Invalid Email or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - TaskForge</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f5f7fa;
}
.login-box {
    max-width: 400px;
    margin: 100px auto;
}
</style>

</head>
<body>

<div class="login-box">

<div class="card shadow-sm p-4 border-0">

<h3 class="mb-2 text-center">Welcome Back 👋</h3>
<p class="text-center text-muted mb-4">Login to continue to TaskForge</p>

<?php if(isset($error)){ ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input class="form-control mb-3" type="email" name="email" placeholder="Email" required>

<input class="form-control mb-3" type="password" name="password" placeholder="Password" required>

<button class="btn btn-primary w-100" name="login">Login</button>

</form>

<p class="mt-3 text-center">
    Don't have an account? <a href="register.php">Register</a>
</p>

</div>

</div>

</body>
</html>