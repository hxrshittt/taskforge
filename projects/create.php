<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../config/db.php");

// ROLE CHECK
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    echo "Access Denied";
    exit();
}

// HANDLE FORM
if(isset($_POST['create'])){
    $name = $_POST['name'];
    $desc = $_POST['desc'];

    $conn->query("INSERT INTO projects (name,description,created_by) 
                  VALUES ('$name','$desc','".$_SESSION['user_id']."')");

    echo "<div class='alert alert-success'>Project Created!</div>";
}
?>

<?php include("../includes/layout_start.php"); ?>

<h2 class="mb-4">Create Project</h2>

<div class="card shadow-sm p-4" style="max-width:500px;">

<form method="POST">

<input class="form-control mb-3" name="name" placeholder="Project Name" required>

<textarea class="form-control mb-3" name="desc" placeholder="Description"></textarea>

<button class="btn btn-primary" name="create">Create Project</button>

</form>

</div>

<?php include("../includes/layout_end.php"); ?>