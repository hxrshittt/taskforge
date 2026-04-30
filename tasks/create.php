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

// FETCH DATA
$projects = $conn->query("SELECT * FROM projects");
$users = $conn->query("SELECT * FROM users");

// HANDLE FORM
$success = false;

if(isset($_POST['create'])){
    $title = $_POST['title'];
    $project_id = $_POST['project_id'];
    $assigned = $_POST['assigned'];
    $deadline = $_POST['deadline'];

    // INSERT TASK
    $conn->query("INSERT INTO tasks (title,project_id,assigned_to,deadline) 
    VALUES ('$title','$project_id','$assigned','$deadline')");

    // ADD MEMBER TO PROJECT (IMPORTANT)
    $conn->query("
    INSERT IGNORE INTO project_members (project_id,user_id) 
    VALUES ('$project_id','$assigned')
    ");

    $success = true;
}
?>

<?php include("../includes/layout_start.php"); ?>

<h2 class="mb-4">Create Task</h2>

<?php if($success){ ?>
<div class="alert alert-success">Task Created Successfully!</div>
<?php } ?>

<div class="card shadow-sm p-4 border-0" style="max-width:500px;">

<form method="POST">

<input class="form-control mb-3" name="title" placeholder="Task Title" required>

<select class="form-control mb-3" name="project_id" required>
<option value="">Select Project</option>
<?php while($p = $projects->fetch_assoc()){ ?>
<option value="<?php echo $p['id']; ?>"><?php echo $p['name']; ?></option>
<?php } ?>
</select>

<select class="form-control mb-3" name="assigned" required>
<option value="">Assign User</option>
<?php while($u = $users->fetch_assoc()){ ?>
<option value="<?php echo $u['id']; ?>"><?php echo $u['name']; ?></option>
<?php } ?>
</select>

<input class="form-control mb-3" type="date" name="deadline" required>

<button class="btn btn-dark w-100" name="create">Create Task</button>

</form>

</div>

<?php include("../includes/layout_end.php"); ?>