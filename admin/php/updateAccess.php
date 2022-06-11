<?php

include '../../database/dbconfig.php';


$id = $_POST['id'];
$state = $_POST['state'];

$user = $_POST['user'];


if ($state == 1) {
    mysqli_query($conn, "DELETE FROM `access` WHERE majorid = $id AND userid = $user");
} else    mysqli_query($conn, "INSERT INTO access VALUES(null, $user, $id)");
