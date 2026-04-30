<?php
include("../config/db.php");

if(isset($_POST['add'])){
    $project_id = $_POST['project_id'];
    $user_id = $_POST['user_id'];

    $conn->query("INSERT INTO project_members (project_id,user_id)
                  VALUES ('$project_id','$user_id')");
}
?>