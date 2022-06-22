<?php
session_start();
include '../../database/dbconfig.php';

$counterid = $_POST['counterid'];
$current = $_POST['currenttoken'];
$next = $_POST['nexttoken'];
$majorid = $_POST['majorid'];
if ($current != 0) {


    $res = $conn->query("SELECT * FROM queue WHERE counterid = $counterid AND token = " . $current['token'] . " AND date_created LIKE '" . $current['date_created'] . "%'");

    if ($res->num_rows > 0) {
        $dd = $res->fetch_assoc()['queueid'];
        $conn->query("DELETE FROM `queue` WHERE queueid = " . $dd);
        $conn->query("UPDATE queue set `status` = 2 WHERE queueid = " . $current['queueid']);
        $conn->query("INSERT INTO `queue` VALUES(null, '" . $current['identification'] . "', '$majorid', " . $current['serviceid'] . " , $counterid, '" . $current['token'] . "', 1, '" . $current['date_created'] . "', 0)");
    } else {
        $conn->query("UPDATE queue set `status` = 2 WHERE queueid = " . $current['queueid']);
        $conn->query("INSERT INTO `queue` VALUES(null, '" . $current['identification'] . "', '$majorid', " . $current['serviceid'] . " , $counterid, '" . $current['token'] . "', 1, '" . $current['date_created'] . "', 0)");
    }
}
// if ($next != 0) {
//     $conn->query("UPDATE `queue` SET iscalled = 1 WHERE queueid = $next");
// }






// echo $current['identification'];
