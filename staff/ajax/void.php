<?php
session_start();
include '../../database/dbconfig.php';


$current = $_POST['currenttoken'];
$next = $_POST['nexttoken'];

if ($current != 0) {
    $conn->query("UPDATE `queue` SET status = 3 WHERE queueid = $current");
}
if ($next != 0) {
    $conn->query("UPDATE `queue` SET iscalled = 1 WHERE queueid = $next");
}






echo $current;
