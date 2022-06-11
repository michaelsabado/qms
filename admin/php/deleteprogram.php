<?php

include '../../database/dbconfig.php';


$id = $_POST['programid'];


if (mysqli_query($conn, "DELETE FROM `program` WHERE programid = $id")) {
    echo 1;
} else echo 0;
