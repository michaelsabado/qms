<?php
session_start();
include '../../database/dbconfig.php';

$date = date("Y-m-d");
$counterid = $_SESSION['user']['counterid'];

$sql = "SELECT * FROM `queue` a INNER JOIN `service` b ON a.serviceid = b.serviceid WHERE a.counterid = $counterid AND a.date_created LIKE '$date%' ORDER BY queueid";
$result = $conn->query($sql);


$queue = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($queue, json_encode($row));
    }
}


exit(json_encode($queue));
