<?php

include '../../database/dbconfig.php';

$counter = $_GET['counter'];
$date = $_GET['date'];

// echo $date;


if ($counter == 'All') {
    $res = $conn->query("SELECT * FROM `queue` a INNER JOIN `service` b on a.serviceid = b.serviceid WHERE a.date_created LIKE '$date%' AND a.status != 1");
} else {
    $res = $conn->query("SELECT * FROM `queue` a INNER JOIN `service` b on a.serviceid = b.serviceid WHERE a.date_created LIKE '$date%' AND a.status != 1 AND a.counterid = $counter");
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
                <th>Service</th>
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



                    echo '<tr>
                        <td>' . $count . '</td>
                        <td>' . $row['identification'] . '</td>
                        <td class="text-nowrap">' . $row['description'] . '</td>
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

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });


    $("#served").text(<?= $served ?>);
    $("#voided").text(<?= $voided ?>);
</script>