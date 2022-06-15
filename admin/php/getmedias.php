<?php

include '../../database/dbconfig.php';


$res = $conn->query("SELECT * FROM uploads ORDER BY id DESC");


if ($res->num_rows > 0) {

    while ($row = $res->fetch_assoc()) {

        $media = explode(".", $row['file_name']);
        if ($media[1] == 'mp4') {
            $str = '<video src="../uploads/' . $row['file_name'] . '" autoplay muted loop class="img-fluid" alt="">';
        } else if ($media[1] == 'jpg' || $media[1] == 'png' || $media[1] == 'jpeg' || $media[1] == 'webp') {
            $str = '<img src="../uploads/' . $row['file_name'] . '" class="img-fluid" alt="">';
        } else {
            $str = '';
        }

        echo ' <div class="col-md-3 col-12 p-3 border round-2">
        <i class="far fa-trash-alt float-end text-danger pointer" onclick="deleteMedia(' . $row['id'] . ')"></i>
        <div class="form-check form-switch mb-2">
        <input class="form-check-input" type="checkbox" role="switch" ' . (($row['isEnabled'] == 1)  ? 'checked' : '') . ' onchange="updateMedia(' . $row['id'] . ', ' . $row['isEnabled'] . ')">
        <label class="form-check-label" ><i class="fas fa-power-off"></i></label>
        </div>
        <div class="d-flex align-items-center bg-secondary round-1" style="height: 300px; overflow: hidden; background-image: linear-gradient(to right top, #005eff, #009eff, #00c5e8, #00e090, #bdee4f);">
        <div>
        ' . $str . '
        </div>
        </div>
     
    </div>';
    }
}
