<?php

include '../../database/dbconfig.php';


$fileData = '';
if (isset($_FILES['file']['name'][0])) {
    foreach ($_FILES['file']['name'] as $keys => $values) {
        $fileName = $_FILES['file']['name'][$keys];
        if (move_uploaded_file($_FILES['file']['tmp_name'][$keys], '../../uploads/' . $values)) {
            $query = "INSERT INTO uploads (file_name, upload_time)VALUES('" . $fileName . "','" . date("Y-m-d H:i:s") . "')";
            mysqli_query($conn, $query);
        }
    }
}
