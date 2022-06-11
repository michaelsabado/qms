<?php

include '../../database/dbconfig.php';


$id = $_POST['majorid'];


if (mysqli_query($conn, "DELETE FROM `major` WHERE majorid = $id")) {
    echo 1;
} else echo 0;
