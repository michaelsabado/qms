<?php

include '../../database/dbconfig.php';


$id = $_POST['userid'];


$sql = "SELECT username FROM user WHERE userid = $id";

$res = $conn->query($sql)->fetch_assoc()['username'];



if (mysqli_query($conn, "UPDATE user SET `password` = '$res' WHERE userid = $id")) {
    echo 1;
} else echo 0;
