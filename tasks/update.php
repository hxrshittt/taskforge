<?php
include("../config/db.php");

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $status = $_POST['status'];

    $conn->query("UPDATE tasks SET status='$status' WHERE id='$id'");
}
?>

<form method="POST">
<input name="id" placeholder="Task ID">
<select name="status">
<option value="pending">Pending</option>
<option value="in_progress">In Progress</option>
<option value="completed">Completed</option>
</select>
<button name="update">Update</button>
</form>

<?php
$status = $row['status'];

if($status == 'pending') echo "<span style='color:orange'>Pending</span>";
if($status == 'in_progress') echo "<span style='color:blue'>In Progress</span>";
if($status == 'completed') echo "<span style='color:green'>Completed</span>";
?>