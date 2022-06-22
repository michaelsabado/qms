<?php
session_start();
include '../../database/dbconfig.php';

$cid = $_POST['counterid'];
$current = $_POST['currenttoken'];


if ($current != 0) {

    $sql = "SELECT * FROM queue WHERE queueid = $current";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        extract($result->fetch_assoc());




        $conn->query("DELETE FROM `queue` WHERE queueid = " . $current);
        $conn->query("INSERT INTO `queue` VALUES(null, '" . $identification . "', '$majorid', " . $serviceid . " , $cid, '" . $token . "', 1, '" . $date_created . "', 0)");
    }
}
// if ($next != 0) {
//     $conn->query("UPDATE `queue` SET iscalled = 1 WHERE queueid = $next");
// }






// echo $current['identification'];
