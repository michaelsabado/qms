<?php
include '../../database/dbconfig.php';




$sql = "SELECT * FROM counter";
$res = $conn->query($sql);

$counter = array();


if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        array_push($counter, $row);
    }
}


exit(json_encode($counter));
