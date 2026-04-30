<?php
include("../config/db.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$project_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// ✅ FETCH PROJECT DETAILS
$project = $conn->query("SELECT * FROM projects WHERE id='$project_id'")->fetch_assoc();

// ❗ SECURITY CHECK (IMPORTANT)
if($_SESSION['role'] != 'admin'){
    $check = $conn->query("
        SELECT * FROM project_members 
        WHERE project_id='$project_id' AND user_id='$user_id'
    ");
    if($check->num_rows == 0){
        echo "Access Denied";
        exit();
    }
}

// FETCH TASKS
if($_SESSION['role'] == 'admin'){
    $tasks = $conn->query("SELECT * FROM tasks WHERE project_id='$project_id'");
} else {
    $tasks = $conn->query("
        SELECT * FROM tasks 
        WHERE project_id='$project_id' AND assigned_to='$user_id'
    ");
}

// HANDLE UPDATE
if(isset($_POST['update'])){
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];

    if($_SESSION['role'] != 'admin'){
        $conn->query("UPDATE tasks 
                      SET status='$status' 
                      WHERE id='$task_id' AND assigned_to='$user_id'");
    } else {
        $conn->query("UPDATE tasks 
                      SET status='$status' 
                      WHERE id='$task_id'");
    }
}
?>

<?php include("../includes/layout_start.php"); ?>

<!-- ✅ PROJECT HEADER -->
<div class="card shadow-sm border-0 p-4 mb-4">

<h3 class="fw-semibold mb-2">
<?php echo htmlspecialchars($project['name']); ?>
</h3>

<p class="text-muted mb-0" style="line-height:1.6;">
<?php echo nl2br(htmlspecialchars($project['description'])); ?>
</p>

</div>

<table class="table align-middle bg-white">
<thead class="table-light">
<tr>
<th>Task</th>
<th>Status</th>
<th>Deadline</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($t = $tasks->fetch_assoc()){ ?>
<tr>

<form method="POST">

<td class="fw-semibold text-dark"><?php echo htmlspecialchars($t['title']); ?></td>

<td>
<select name="status" class="form-select form-select-sm">

<option value="pending" <?php if($t['status']=='pending') echo 'selected'; ?>>Pending</option>

<option value="in_progress" <?php if($t['status']=='in_progress') echo 'selected'; ?>>In Progress</option>

<option value="completed" <?php if($t['status']=='completed') echo 'selected'; ?>>Completed</option>

</select>

<?php
if($t['deadline'] < date('Y-m-d') && $t['status'] != 'completed'){
    echo "<br><span class='badge bg-danger mt-1'>Overdue</span>";
}
?>
</td>

<td><?php echo $t['deadline']; ?></td>

<td>
<input type="hidden" name="task_id" value="<?php echo $t['id']; ?>">
<button class="btn btn-dark btn-sm" name="update">Update</button>
</td>

</form>

</tr>
<?php } ?>
</tbody>

</table>

<?php include("../includes/layout_end.php"); ?>