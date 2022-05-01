<?php
include '../../database/dbconfig.php';


$id = $_POST['queueid'];

$sql = "UPDATE `queue` SET iscalled = 2 WHERE queueid = $id";
$conn->query($sql);
