<?php
include '../../database/dbconfig.php';


$id = $_POST['id'];

$sql = "SELECT counterid, status FROM counter";
$res = $conn->query($sql);

$counter = array();


if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        array_push($counter, json_encode($row));
    }
}


exit(json_encode($counter));
