<?php
session_start();
include '../../database/dbconfig.php';


$current = $_POST['id'];

$conn->query("UPDATE `queue` SET iscalled = 1 WHERE queueid = $current");


echo $current;
