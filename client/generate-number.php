<?php
session_start();
include '../database/dbconfig.php';


$identification = check_input($_POST['identification']);


$program = check_input($_POST['program']);
$major = check_input($_POST['major']);
$serviceid = check_input($_POST['service']);

$time = date('Y-m-d h:i:s');
$token = date('is');
$today = date('Y-m-d');


$sql = "SELECT * FROM token WHERE date = '$today'";
$res = $conn->query($sql);

if ($res->num_rows > 0) {
    $t = $res->fetch_assoc();
    $token = $t['token'] + 1;
    $sql = "UPDATE  token set token = '$token' WHERE `date` = '$today'";
    $conn->query($sql);
} else {
    $sql = "INSERT INTO token VALUES(null, '$today', '1001')";
    $conn->query($sql);
    $token = 1001;
}


if ($serviceid != 54) {
    //fetching the assigned counter/window
    $sql = "SELECT b.counterid FROM access a INNER JOIN user b on a.userid = b.userid WHERE a.majorid = $major";
    $res = $conn->query($sql);

    if ($res->num_rows > 0) {

        $d = $res->fetch_assoc();

        $sql = "INSERT INTO queue VALUES(null, '$identification', '$major', $serviceid, " . $d['counterid'] . ", '$token', 1, '$time', 0)";
        $conn->query($sql);

        echo $conn->insert_id;
    }
} else {
    $sql = "SELECT DISTINCT(userid) FROM access";
    $res = $conn->query($sql);
    $users = array();
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            array_push($users, $row['userid']);
        }
        $sql = "SELECT * FROM user WHERE userid NOT IN (" . implode(",", $users) . ") AND counterid IS NOT NULL";
        $res = $conn->query($sql);

        if ($res->num_rows > 0) {
            $d = $res->fetch_assoc();
            $sql = "INSERT INTO queue VALUES(null, '$identification', '$major', $serviceid, " . $d['counterid'] . ", '$token', 1, '$time', 0)";
            $conn->query($sql);
            echo $conn->insert_id;
        } else {
            echo 102;
        }
    } else {
        echo 102;
    }
}





// $conn->query($sql);




function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
