<?php
session_start();
include '../database/dbconfig.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['usertype'] != 2) {
    header("Location: ../main/login.php");
}
$counter = $_SESSION['user']['counterid'];

$date = (isset($_GET['date']) && $_GET['date'] != "") ? $_GET['date'] : date('Y-m-d');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../partials/_header.php' ?>
    <title>Window <?= $_SESSION['user']['windowno'] ?></title>

</head>

<body class="bg-light">


    <div class="d-flex ">
        <?php include '../partials/_sidenav.php' ?>
        <div class="myvh  w-100">

            <?php include '../partials/_nav.php' ?>

            <div class="content p-5 pb-0">
                <div class="h4 fw-  mb-4"><i class="fa-solid fa-book me-3"></i>Records</div>
                <div class="" style="height: calc(100vh - 190px); overflow-y: auto">


                    <div class="card round-2 border-0 shadow-sm  mb-3">
                        <div class="card-body p-4">
                            <div style="max-width: 300px">
                                <div class="h6 fw-bold">Fetch Record</div>
                                <div class="smalltxt">Select date</div>
                                <form action="" method="get">
                                    <input type="date" name="date" id="sel-date" class="form-control round-1 mb-3" value="<?= $date ?>">
                                    <button type=submit class="btn btn-primary round-1 shadow-sm me-2">Fetch <i class="fa-solid fa-download ms-2"></i></button>

                                    <button type="button" class="btn btn-success round-1 shadow-sm" onclick="printMe()">Create PDF <i class="fas fa-print ms-2"></i></button>
                                </form>

                            </div>

                        </div>
                    </div>

                    <div class="card round-2 border-0 shadow-sm  mb-3">
                        <div class="card-body p-4">
                            <?php

                            // echo $date;


                            if ($counter == 'All') {
                                $res = $conn->query("SELECT * FROM `queue` a INNER JOIN `service` b on a.serviceid = b.serviceid  INNER JOIN major c ON a.majorid = c.majorid INNER JOIN program d ON c.programid = d.programid WHERE a.date_created LIKE '$date%' AND a.status != 1");
                            } else {
                                $res = $conn->query("SELECT * FROM `queue` a INNER JOIN `service` b on a.serviceid = b.serviceid INNER JOIN major c ON a.majorid = c.majorid INNER JOIN program d ON c.programid = d.programid WHERE a.date_created LIKE '$date%' AND a.status != 1 AND a.counterid = $counter");
                            }



                            ?>





                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card round-2 bg-light  shadow-sm  mb-3 ">
                                        <div class="card-body p-4">
                                            <div class="h6 fw-bold text-primary">Served</div>
                                            <div class="display-5" id="served">0</div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card round-2 bg-light shadow-sm  mb-3 ">
                                        <div class="card-body p-4">
                                            <div class="h6 fw-bold text-danger">Voided</div>
                                            <div class="display-5" id="voided">0</div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">


                                <table id="example" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Identification</th>
                                            <th>Program</th>
                                            <th>Purpose</th>

                                            <th>Token</th>
                                            <th>Status</th>
                                            <th>Timestamp</th>
                                        </tr>
                                    </thead>
                                    <tbody>





                                        <?php

                                        $served = 0;
                                        $voided = 0;

                                        if ($res->num_rows > 0) {
                                            $count = 1;
                                            while ($row = $res->fetch_assoc()) {

                                                if ($row['status'] == 2) {
                                                    $served++;
                                                    $stats = "Served";
                                                } else if ($row['status'] == 3) {
                                                    $voided++;
                                                    $stats = "Voided";
                                                }
                                                $type = '';
                                                switch ($row['category']) {
                                                    case '1':
                                                        $type = 'Request';
                                                        break;
                                                    case '2':
                                                        $type = 'Enrollment';
                                                        break;
                                                    case '3':
                                                        $type = 'Application';
                                                        break;
                                                    case '4':
                                                        $type = 'Claiming';
                                                        break;
                                                    case '5':
                                                        $type = 'Submission';
                                                        break;
                                                    case '6':
                                                        $type = 'Query & Others';
                                                        break;
                                                }

                                                echo '<tr valign="middle">
                                                    <td>' . $count . '</td>
                                                    <td>' . $row['identification'] . '</td>
                                                    <td>' . $row['programdescription'] . '<br>
                                                    <span class="text-nowrap smalltxt">' . $row['majordescription'] . '</span</td>
                                                    <td>' . $type . '<br>
                                                    <span class="text-nowrap smalltxt">' . $row['description'] . '</span</td>
                                                    <td>' . $row['token'] . '</td>
                                                    <td>' . $stats . '</td>
                                                    <td>' . $row['date_created'] . '</td>
                                                </tr>';
                                                $count++;
                                            }
                                        }


                                        ?>
                                    </tbody>

                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>





        </div>



        <?php include '../partials/_admin_footer.php' ?>

        <script>
            function printMe() {
                window.location.href = "print.php?date=" + $("#sel-date").val();



            }


            $(document).ready(function() {
                $('#example').DataTable();
            });
            $(" #nav-records").addClass('mynav-active');


            $("#served").text(<?= $served ?>);
            $("#voided").text(<?= $voided ?>);
        </script>
</body>

</html>