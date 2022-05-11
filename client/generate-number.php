<?php
session_start();
include '../database/dbconfig.php';


$identification = check_input($_POST['identification']);
$counterid = check_input($_POST['counterid']);
$serviceid = check_input($_POST['serviceid']);

$time = date('Y-m-d h:i:s');
$token = date('hi');

$sql = "INSERT INTO queue VALUES(null, '$identification', $serviceid, $counterid, '$token', 1, '$time', 0)";
$conn->query($sql);

echo $conn->insert_id;

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
