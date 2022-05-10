<?php

include '../../database/dbconfig.php';


$id = $_POST['mediaid'];


if (mysqli_query($conn, "DELETE FROM `uploads` WHERE id = $id")) {
    echo 1;
} else echo 0;
