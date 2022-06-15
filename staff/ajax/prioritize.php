<?php
session_start();
include '../../database/dbconfig.php';

$active = $_POST['active'];
$current = $_POST['currenttoken'];
$next = $_POST['priotoken'];

if ($active != 0) {
    $conn->query("UPDATE `queue` SET status = 2 WHERE queueid = $current");
}
if ($next != 0) {
    $conn->query("UPDATE `queue` SET iscalled = 1 WHERE queueid = $next");
}
