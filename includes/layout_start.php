<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>TaskForge</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f1f5f9;
    font-family: 'Inter', 'Segoe UI', sans-serif;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    height: 100vh;
    position: fixed;
    background: #0f172a;
    padding: 20px;
    color: white;
}

.sidebar h4 {
    font-weight: 600;
}

.sidebar a {
    display: block;
    padding: 10px 12px;
    border-radius: 10px;
    color: #cbd5f5;
    text-decoration: none;
    margin-bottom: 6px;
    transition: 0.2s;
}

.sidebar a:hover {
    background: #1e293b;
    color: white;
}

/* CONTENT */
.content {
    margin-left: 260px;
    padding: 30px;
}

/* CARD */
.card {
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

/* TABLE */
.table {
    border-radius: 12px;
    overflow: hidden;
}

/* BUTTON */
.btn {
    border-radius: 10px;
}

/* HEADINGS */
h2, h3, h5 {
    letter-spacing: -0.3px;
}
</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4 class="mb-4">🚀 TaskForge</h4>
    <hr>

    <a href="../dashboard/index.php">📊 Dashboard</a>
    <a href="../projects/list.php">📁 Projects</a>

    <?php if($_SESSION['role']=='admin'){ ?>
    <a href="../projects/create.php">📁 Create Project</a>
    <a href="../tasks/create.php">➕ Assign Task</a>
    <?php } ?>

    <a href="../auth/logout.php" class="text-danger mt-3">🚪 Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center mb-4">

<h4 class="fw-semibold mb-0">Welcome 👋</h4>

<div class="text-muted">
<?php echo $_SESSION['role']; ?>
</div>

</div>