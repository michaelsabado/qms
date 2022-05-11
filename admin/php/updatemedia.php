<?php

include '../../database/dbconfig.php';


$id = $_POST['id'];
$val = $_POST['val'];

if (mysqli_query($conn, "UPDATE uploads SET isEnabled = $val WHERE id = $id")) {
    echo 1;
} else echo 0;
