<?php
include("../config/db.php");

header("Content-Type: application/json");

$result = $conn->query("SELECT * FROM tasks");

$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>