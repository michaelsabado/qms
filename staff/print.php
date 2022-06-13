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
    <style>
        .container {
            max-width: 8in;
            padding: 0.3in;
            background-color: white;
            min-height: 11in;
        }

        body {
            font-size: 12px !important;
        }


        .h6 {
            font-size: 14px;
        }

        .smalltxt {
            font-size: 10px
        }
    </style>
</head>

<body class="bg-light">




    <div class="container " id="element-to-print">

        <?php

        // echo $date;


        if ($counter == 'All') {
            $res = $conn->query("SELECT * FROM `queue` a INNER JOIN `service` b on a.serviceid = b.serviceid  INNER JOIN major c ON a.majorid = c.majorid INNER JOIN program d ON c.programid = d.programid WHERE a.date_created LIKE '$date%' AND a.status != 1");
        } else {
            $res = $conn->query("SELECT * FROM `queue` a INNER JOIN `service` b on a.serviceid = b.serviceid INNER JOIN major c ON a.majorid = c.majorid INNER JOIN program d ON c.programid = d.programid WHERE a.date_created LIKE '$date%' AND a.status != 1 AND a.counterid = $counter");
        }



        ?>




        <div class="text-start d-flex mb-2 align-items-center py-3 mb-3">
            <div>
                <img src="../images/psu.png" class=" me-3" height="50" alt="">
            </div>
            <div>
                <div class="h6 fw-bold mb-0">School of Advanced Studies</div>
                <div class="text " style="font-size: 13px">Pangasinan State University Urdaneta Campus</div>
            </div>
            <div class="ms-auto align-self-start">
                <div class="h6 fw-bold mb-0">QMS Report</div>
            </div>

        </div>
        <div class="text-start">
            <div class="h6"><b>Window:</b> #<?= $_SESSION['user']['windowno'] ?></div>
            <div class="h6"><b>User: </b> <?= $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'] ?></div>
            <div class="h6"><b>Date:</b> <?= $_GET['date'] ?></div>
        </div>
        <hr>
        <div class="">
            <div class="h6">
                <span class="badge bg-primary fw-light">Summary</span>
            </div>
            <div class="ps-2">
                <div class="h6"><b>Served:</b> <span id="served"></span></div>
                <div class="h6"><b>Voided:</b> <span id="voided"></span></div>
            </div>
            <div class="h6">
                <span class="badge bg-primary fw-light">Queue Records</span>
            </div>
            <table id="" class="table table-bordered">
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

                            echo '<tr valign="">
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





    <?php include '../partials/_admin_footer.php' ?>
    <script src="../partials/html2pdf.bundle.min.js"></script>
    <script>
        $("#served").text(<?= $served ?>);
        $("#voided").text(<?= $voided ?>);
        var element = document.getElementById('element-to-print');
        var opt = {
            margin: 0,
            filename: '<?= $_GET['date'] ?>_QMS-Report.pdf',
            image: {
                type: 'jpeg',
                quality: 1
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'letter',
                orientation: 'portrait'
            }
        };

        html2pdf().set(opt).from(element).save();

        setTimeout(function() {
            window.location.href = "records.php?date=" + "<?= $_GET['date'] ?>";
        }, 1000);
    </script>
</body>

</html>