<?php

include '../database/dbconfig.php';


$id = $_POST['id'];


$result = mysqli_query($conn, "SELECT * FROM service WHERE category = $id ORDER BY description");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        echo '<option value="' . $row['serviceid'] . '">' . $row['description'] . '</option>';
    }
}
