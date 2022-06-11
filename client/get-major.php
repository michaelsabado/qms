<?php

include '../database/dbconfig.php';


$id = $_POST['id'];


$result = mysqli_query($conn, "SELECT * FROM major WHERE programid = $id");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo '<option value="' . $row['majorid'] . '">' . $row['majordescription'] . '</option>';
    }
}
