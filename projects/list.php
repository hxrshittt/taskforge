<?php
include("../config/db.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// ROLE BASED PROJECT FETCH
if($_SESSION['role'] == 'admin'){
    $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
} else {
    $result = $conn->query("
        SELECT p.* 
        FROM projects p
        JOIN project_members pm ON p.id = pm.project_id
        WHERE pm.user_id = '$user_id'
        ORDER BY p.id DESC
    ");
}
?>

<?php include("../includes/layout_start.php"); ?>

<h2 class="mb-4 fw-semibold">Projects</h2>

<div class="row">

<?php if($result->num_rows == 0){ ?>
    <p class="text-muted">No projects available</p>
<?php } ?>

<?php while($row = $result->fetch_assoc()){ ?>
<div class="col-md-4">

<div class="card shadow-sm border-0 p-3 mb-3">

<h5 class="fw-semibold">
<?php echo htmlspecialchars($row['name']); ?>
</h5>

<!-- ✅ DESCRIPTION FIX -->
<p class="text-muted" style="min-height:60px;">
<?php 
$desc = htmlspecialchars($row['description']);
echo strlen($desc) > 100 ? substr($desc,0,100)."..." : $desc;
?>
</p>

<a href="../projects/view.php?id=<?php echo $row['id']; ?>" 
   class="btn btn-dark btn-sm">
View Details
</a>

</div>

</div>
<?php } ?>

</div>

<?php include("../includes/layout_end.php"); ?>