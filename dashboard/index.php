<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

include("../config/db.php");

$user_id = $_SESSION['user_id'];

// 👉 ROLE-BASED FILTER
if($_SESSION['role'] == 'admin'){
    $total = $conn->query("SELECT COUNT(*) as c FROM tasks")->fetch_assoc()['c'];
    $pending = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='pending'")->fetch_assoc()['c'];
    $inprogress = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='in_progress'")->fetch_assoc()['c'];
    $completed = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='completed'")->fetch_assoc()['c'];

    // ✅ OVERDUE COUNT
    $overdue = $conn->query("
        SELECT COUNT(*) as c 
        FROM tasks 
        WHERE deadline < CURDATE() AND status != 'completed'
    ")->fetch_assoc()['c'];

} else {
    // 👉 MEMBER ONLY THEIR TASKS
    $total = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE assigned_to='$user_id'")->fetch_assoc()['c'];
    $pending = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='pending' AND assigned_to='$user_id'")->fetch_assoc()['c'];
    $inprogress = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='in_progress' AND assigned_to='$user_id'")->fetch_assoc()['c'];
    $completed = $conn->query("SELECT COUNT(*) as c FROM tasks WHERE status='completed' AND assigned_to='$user_id'")->fetch_assoc()['c'];

    // ✅ OVERDUE FOR MEMBER
    $overdue = $conn->query("
        SELECT COUNT(*) as c 
        FROM tasks 
        WHERE deadline < CURDATE() 
        AND status != 'completed'
        AND assigned_to='$user_id'
    ")->fetch_assoc()['c'];
}
?>

<?php include("../includes/layout_start.php"); ?>

<h2 class="mb-4 fw-semibold">Dashboard Overview</h2>

<div class="row">

    <div class="col-md-3">
    <div class="card border-0 p-3 mb-3">
        <h6 class="text-muted mb-2">Total Tasks</h6>
        <h2 class="fw-bold"><?php echo $total; ?></h2>
    </div>
</div>

    <div class="col-md-3">
    <div class="card border-0 p-3 mb-3">
        <h6 class="text-muted mb-2">Pending</h6>
        <h2 class="fw-bold"><?php echo $pending; ?></h2>
    </div>
</div>

    <div class="col-md-3">
    <div class="card border-0 p-3 mb-3">
        <h6 class="text-muted mb-2">In Progress</h6>
        <h2 class="fw-bold"><?php echo $inprogress; ?></h2>
    </div>
</div>

    <div class="col-md-3">
    <div class="card border-0 p-3 mb-3">
        <h6 class="text-muted mb-2">Completed</h6>
        <h2 class="fw-bold"><?php echo $completed; ?></h2>
    </div>
</div>

    <div class="col-md-3">
    <div class="card border-0 p-3 mb-3">
        <h6 class="text-muted mb-2">Overdue</h6>
        <h2 class="fw-bold text-danger"><?php echo $overdue; ?></h2>
    </div>
</div>

</div>

<?php include("../includes/layout_end.php"); ?>