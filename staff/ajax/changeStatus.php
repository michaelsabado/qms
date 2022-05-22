<?php
session_start();
include '../../database/dbconfig.php';


$id = $_POST['id'];
$status = $_POST['status'];


if ($status == 1) $status = 2;
else if ($status == 2) $status = 1;

$_SESSION['user']['status'] = $status;

$conn->query("UPDATE `counter` SET `status` = $status WHERE counterid = $id");
echo $status;
