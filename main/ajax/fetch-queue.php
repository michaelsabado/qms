<?php
include '../../database/dbconfig.php';


$date = date("Y-m-d");
$id = $_POST['id'];

$sql = "SELECT * FROM `queue` WHERE date_created LIKE '$date%' AND `status` = 1 AND counterid = $id";
$result = $conn->query($sql);


$queue = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($queue, json_encode($row));
    }
}


exit(json_encode($queue));
