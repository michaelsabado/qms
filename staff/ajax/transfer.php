<?php
session_start();
include '../../database/dbconfig.php';

$counterid = $_POST['counterid'];
$current = $_POST['currenttoken'];
$next = $_POST['nexttoken'];
$majorid = $_POST['majorid'];
if ($current != 0) {
    $conn->query("DELETE FROM `queue` WHERE queueid = " . $current['queueid']);
    $conn->query("INSERT INTO `queue` VALUES(null, '" . $current['identification'] . "', '$majorid', " . $current['serviceid'] . " , $counterid, '" . $current['token'] . "', 1, '" . $current['date_created'] . "', 0)");
}
if ($next != 0) {
    $conn->query("UPDATE `queue` SET iscalled = 1 WHERE queueid = $next");
}






// echo $current['identification'];
