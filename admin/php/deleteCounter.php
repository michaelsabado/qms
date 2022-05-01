<?php

include '../../database/dbconfig.php';


$id = $_POST['counterid'];


if (mysqli_query($conn, "DELETE FROM counter WHERE counterid = $id")) {
    echo 1;
} else echo 0;
