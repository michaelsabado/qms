<?php
session_start();
include '../../database/dbconfig.php';


$current = $_POST['currenttoken'];


if ($current != 0) {
    $conn->query("UPDATE `queue` SET status = 2 WHERE queueid = $current");
}
