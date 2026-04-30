<?php
include("../config/db.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

// HANDLE STATUS UPDATE
if(isset($_POST['update'])){
    $task_id = $_POST['task_id'];
    $status = $_POST['status'];

    if($_SESSION['role'] != 'admin'){
        $conn->query("UPDATE tasks 
                      SET status='$status' 
                      WHERE id='$task_id' AND assigned_to='".$_SESSION['user_id']."'");
    } else {
        $conn->query("UPDATE tasks 
                      SET status='$status' 
                      WHERE id='$task_id'");
    }

    header("Location: list.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// FETCH TASKS WITH PROJECT NAME + DESCRIPTION
if($_SESSION['role'] == 'admin'){
    $result = $conn->query("
        SELECT t.*, p.name as project_name, p.description 
        FROM tasks t
        JOIN projects p ON t.project_id = p.id
        ORDER BY t.id DESC
    ");
} else {
    $result = $conn->query("
        SELECT t.*, p.name as project_name, p.description 
        FROM tasks t
        JOIN projects p ON t.project_id = p.id
        WHERE t.assigned_to='$user_id'
        ORDER BY t.id DESC
    ");
}
?>

<?php include("../includes/layout_start.php"); ?>

<h2 class="mb-4 fw-semibold">My Tasks</h2>

<table class="table align-middle bg-white">
<thead class="table-light">
<tr>
<th>Project</th>
<th>Title</th>
<th>Status</th>
<th>Deadline</th>
<th>Action</th>
</tr>
</thead>

<tbody>
<?php while($row = $result->fetch_assoc()){ ?>
<tr>

<form method="POST">

<!-- PROJECT COLUMN WITH BUTTON -->
<td>

<strong>
<?php echo substr(htmlspecialchars($row['project_name']), 0, 25); ?>...
</strong>

<br>

<button 
type="button"
class="btn btn-sm btn-outline-dark mt-1"
data-bs-toggle="modal"
data-bs-target="#projectModal<?php echo $row['project_id']; ?>">
View
</button>

</td>

<td class="fw-semibold text-dark">
<?php echo htmlspecialchars($row['title']); ?>
<input type="hidden" name="task_id" value="<?php echo $row['id']; ?>">
</td>

<td>
<select name="status" class="form-select form-select-sm">

<option value="pending" <?php if($row['status']=='pending') echo 'selected'; ?>>Pending</option>

<option value="in_progress" <?php if($row['status']=='in_progress') echo 'selected'; ?>>In Progress</option>

<option value="completed" <?php if($row['status']=='completed') echo 'selected'; ?>>Completed</option>

</select>

<?php
if($row['deadline'] < date('Y-m-d') && $row['status'] != 'completed'){
    echo "<br><span class='badge bg-danger mt-1'>Overdue</span>";
}
?>
</td>

<td><?php echo $row['deadline']; ?></td>

<td>
<button class="btn btn-sm btn-dark" name="update">Update</button>
</td>

</form>

</tr>

<!-- MODAL -->
<div class="modal fade" id="projectModal<?php echo $row['project_id']; ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title"><?php echo htmlspecialchars($row['project_name']); ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><?php echo htmlspecialchars($row['description']); ?></p>
      </div>

    </div>
  </div>
</div>

<?php } ?>
</tbody>

</table>

<?php include("../includes/layout_end.php"); ?>