<?php

include '../../database/dbconfig.php';


$id = $_POST['userid'];


if (mysqli_query($conn, "DELETE FROM user WHERE userid = $id")) {
    echo 1;
} else echo 0;
