<?php
session_start();
include '../../database/dbconfig.php';


$res = $conn->query("SELECT * FROM counter WHERE counterid != " . $_SESSION['user']['counterid'] . " ORDER BY windowno");


if ($res->num_rows > 0) {


    while ($row = $res->fetch_assoc()) {

        if ($row['status'] == 1) {
            $status = "Open";
        } else {
            $status = "Closed";
        }


        echo '<div class="card round-1 pointer shadow-sm bg-light mb-3 cb"  onclick="transferToken(' . $row['counterid'] . ')">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center">
                                <div class="h1 mb-0 fw-"> <i class="fa-solid fa-window-maximize me-3"></i>
                                </div>
                                <div>
                                    <div class="h5 mb-0 fw-bold">
                                        Window ' . $row['windowno'] . '
                                    </div>
                                    <div class="smalltxt">Status: ' . $status . '</div>
                                </div>
                              
                            </div>
                        </div>
                    </div>';
    }
}
