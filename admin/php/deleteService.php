<?php

include '../../database/dbconfig.php';


$id = $_POST['serviceid'];


if (mysqli_query($conn, "DELETE FROM `service` WHERE serviceid = $id")) {
    echo 1;
} else echo 0;
