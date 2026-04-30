<!DOCTYPE html>
<html>
<head>
<title>TaskForge</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <span class="navbar-brand">TaskForge</span>
        <span>
            <?php 
            if(isset($_SESSION['role'])){
                echo "Role: " . $_SESSION['role']; 
            }
            ?>
        </span>
    <?php include("../includes/layout_end.php"); ?>
</nav>